#!/usr/bin/python

import os
import sys
import string
import random
import re
import logging
import datetime

from SqlHandling import SqlHandling
from FileTreatment import FileTreatment
from Logging import Logging

def generateName(extension):
  numOfChars = 10
  return ''.join(random.choice(string.ascii_uppercase) for _ in range(numOfChars)) + extension

def getPlayerOrCoach(string):
  isSportman = 'Deportista'
  patternSport = re.compile(isSportman)
  if patternSport.search(string):
    return 'player'
  return 'coach'

def getId(data):
  query = 'SELECT id FROM personalData WHERE name = \"%s\" AND surname = \"%s\";' % (data['name'], data['surname'])
  log.logDebug(query)
  sqlHandling = SqlHandling()
  sqlHandling.establishConnection()
  sqlHandling.sendQuery(query)
  result = -1 
  if 0 < sqlHandling.getRowCount():
    result = sqlHandling.fetchOneData()
  sqlHandling.closeConnection()
  return result

def exists(id):
  query = 'SELECT id FROM playerData WHERE personalData_id = %s;' % (str(id))
  log.logDebug(query)
  sqlHandling = SqlHandling()
  sqlHandling.establishConnection()
  sqlHandling.sendQuery(query)
  exists = 0
  if 0 < sqlHandling.getRowCount():
    exists = 1
  sqlHandling.closeConnection()
  return exists

def alterPersonalData(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  data = {'name'        : arrayForQuery[3],
          'surname'     : arrayForQuery[4],
          'id'          : 0
  }

  data['id'] = getId(data)
  log.logDebug('Person %s %s has id %s' % (data['name'], data['surname'], data['id']))
  if -1 != data['id']:
    if 'player' == getPlayerOrCoach(string):
      query = 'UPDATE personalData SET is_player'
    else:
      query = 'UPDATE personalData SET is_coach'
    query += '=1 WHERE id = %s;\n' % (str(data['id']))
    return query
  return ''

def getCategory(string):
  if 'sub 21' == string:
    return 'senior'
  elif 'sub 18' == string:
    return 'sub18'
  elif 'sub 16' == string:
    return 'sub16'
  elif 'sub 14' == string:
    return 'sub14'
  elif 'sub 12' == string:
    return 'sub12'
  elif 'sub 10' == string:
    return 'sub10'
  elif 'sub 8' == string:
    return 'sub8'
  elif 'sub 6' == string:
    return 'sub6'
  elif string.find('femenina') != -1: 
    return 'femenino'
  elif 'junior' == string:
    return 'senior'
  else: 
    return 'senior'

def getDefaultSeason():
  query = 'SELECT id FROM season WHERE defaultseason = 1;'
  sqlHandling = SqlHandling()
  sqlHandling.establishConnection()
  sqlHandling.sendQuery(query)
  result = sqlHandling.fetchOneData()
  sqlHandling.closeConnection()
  return str(result)

def existsAsPlayerOrCoachData(id, season, table):
  query = 'SELECT id FROM %s WHERE personalData_id = %s AND season_id = %s;' % (table, str(id), str(season))
  log.logDebug('%s' % (query))
  sqlHandling = SqlHandling()
  sqlHandling.establishConnection()
  sqlHandling.sendQuery(query)
  if 0 < sqlHandling.getRowCount():
    return sqlHandling.fetchOneData()
  return -1

def insertIntoPlayerOrCoachData(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  data = {'number'      : arrayForQuery[0],
          'name'        : arrayForQuery[3],
          'surname'     : arrayForQuery[4],
          'category'    : arrayForQuery[6].lower(),
          'id'          : 0
  }
  data['id'] = getId(data)
  defaultSeason = getDefaultSeason()
  if -1 != data['id']:
    tableName = 'coachData'
    if 'player' == getPlayerOrCoach(string):
      tableName = 'playerData'
    exists = existsAsPlayerOrCoachData(data['id'], defaultSeason, tableName)
      
    if -1 != exists:
      query = 'UPDATE %s SET category = \"%s\", number = %s, personalData_id = %s, season_id = %s WHERE id = %s;\n' % (tableName, getCategory(data['category']), data['number'], str(data['id']), str(defaultSeason), str(exists))
    else:
      query = 'INSERT INTO %s(category, number, personalData_id, season_id) ' % (tableName)
      query += 'VALUES(\"%s\", %s, %s, %s);\n' % (getCategory(data['category']), data['number'], str(data['id']), str(defaultSeason))
    log.logDebug('%s' % (query))
    return query
  return ''

def parsingFile(source, destiny):
  log.logInfo('Parsing file...')
  frmIdNumber = '^\d{7},'
  pattern = re.compile(frmIdNumber)
  if source.readFile() == -1:
    log.logInfo('File %s does not exist' % (source.name))
    return -1
  destiny.editFile()
  for line in source.file:
    if pattern.search(line):
      sqlQuery = alterPersonalData(line)
      destiny.writeIntoFile(sqlQuery)
      sqlQuery = insertIntoPlayerOrCoachData(line)
      destiny.writeIntoFile(sqlQuery)
  source.closeFile()
  destiny.closeFile()
  return 1 

def populateDB(fileGenerated):
  log.logInfo("Populating database")
  sqlHandling = SqlHandling()
  sqlHandling.populateDB(fileGenerated)

def main():
  if len(sys.argv) < 2:
    print "error! Not enough arguments\nUsage: python playerData.py file.csv [info|debug]"
    return -1
  pathOfFileToParse = sys.argv[1]
  global log
  if len(sys.argv) == 3 and sys.argv[2] != None:
    log = Logging(sys.argv[2])
    log.logInfo('Executing: python %s %s %s' % (sys.argv[0], sys.argv[1], sys.argv[2]))
  else:
    log = Logging() 
    log.logInfo('Executing: python %s %s' % (sys.argv[0], sys.argv[1]))
  log.logInfo('Execution starts')
  fileToParse = FileTreatment(pathOfFileToParse)
  log.logInfo('File to be parsed: %s' % (pathOfFileToParse))
  pathOfFileGenerated = os.path.join(os.getcwd(), generateName('.sql'))
  log.logInfo('File generated: %s' % (pathOfFileGenerated))
  fileGenerated = FileTreatment(pathOfFileGenerated)
  if parsingFile(fileToParse, fileGenerated) != -1:
    if fileGenerated.readFile() == -1:
      log.logInfo('File %s wrongly generated' % (fileGenerated))
    populateDB(fileGenerated.file)
    fileToParse.deleteFile()
    fileGenerated.deleteFile()
    log.logInfo('Execution ends\n\n')
    return 1
  else:
    print 'error! Wrong file'
    log.logInfo('Execution ends with failures\n\n')
  return -1
  
main()
