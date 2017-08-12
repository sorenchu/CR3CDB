#!/usr/bin/python

import os
import sys
import string
import random
import re

from SqlHandling import SqlHandling
from FileTreatment import FileTreatment

def generateName(extension):
  numOfChars = 10
  return ''.join(random.choice(string.ascii_uppercase) for _ in range(numOfChars)) + extension

def getPlayerOrCoach(string):
  isSportman = 'Deportista'
  patternSport = re.compile(isSportman)
  if patternSport.search(string):
    return 'player'
  return 'coach'

def getId(arrayForQuery):
  query = 'SELECT id FROM personalData WHERE name = \"' + arrayForQuery[3] + '\" AND surname = \"' + arrayForQuery[4] + '\";'
  sqlHandling = SqlHandling()
  sqlHandling.establishConnection()
  sqlHandling.sendQuery(query)
  result = -1 
  if 0 < sqlHandling.getRowCount():
    result = sqlHandling.fetchOneData()
  sqlHandling.closeConnection()
  return result

def exists(id):
  query = 'SELECT id FROM playerData WHERE personalData_id = ' + str(id) + ';'
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
  personalDataId = getId(arrayForQuery)
  if -1 != personalDataId:
    if 'player' == getPlayerOrCoach(string):
      query = 'UPDATE personalData SET is_player'
    else:
      query = 'UPDATE personalData SET is_coach'
    query += '=1 WHERE id = ' + str(personalDataId) + ';\n'
    return query
  return ''

def getCategory(string):
  if 'Sub 21' == string:
    return 'senior'
  elif 'Sub 18' == string:
    return 'sub18'
  elif 'Sub 16' == string:
    return 'sub16'
  elif 'Sub 14' == string:
    return 'sub14'
  elif 'Sub 12' == string:
    return 'sub12'
  elif 'Sub 10' == string:
    return 'sub10'
  elif 'Sub 8' == string:
    return 'sub8'
  elif 'Sub 6' == string:
    return 'sub6'
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
  query = 'SELECT id FROM ' + table + ' WHERE personalData_id = ' + str(id) + ' AND season_id = ' + str(season) + ';'
  sqlHandling = SqlHandling()
  sqlHandling.establishConnection()
  sqlHandling.sendQuery(query)
  if 0 < sqlHandling.getRowCount():
    return sqlHandling.fetchOneData()
  return -1

def insertIntoPlayerOrCoachData(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  personalDataId = getId(arrayForQuery)
  defaultSeason = getDefaultSeason()
  if -1 != personalDataId:
    if 'player' == getPlayerOrCoach(string):
      exists = existsAsPlayerOrCoachData(personalDataId, defaultSeason, 'playerData')
      if -1 != exists:
        query = 'UPDATE playerData SET category = \"' + getCategory(arrayForQuery[6]) + '\", number = ' + arrayForQuery[0] + ', personalData_id= ' + str(personalDataId) + ', season_id = ' + str(defaultSeason) + ' WHERE id = ' + str(exists) + ';\n'
      else:
        query = 'INSERT INTO playerData(category, number, personalData_id, season_id) '
        query += 'VALUES(\"' + getCategory(arrayForQuery[6]) + '\", ' + arrayForQuery[0] + ', ' + str(personalDataId) + ', ' + defaultSeason + ');\n'
    else:
      exists = existsAsPlayerOrCoachData(personalDataId, defaultSeason, 'playerData')
      if -1 != exists:
        query = 'UPDATE coachData SET category = \"' + getCategory(arrayForQuery[6]) + '\", number = ' + arrayForQuery[0] + ', personalData_id= ' + str(personalDataId) + ', season_id = ' + str(defaultSeason) + ' WHERE id = ' + str(exists) + ';\n'
      else:
        query = 'INSERT INTO coachData(category, number, personalData_id, season_id) '
        query += 'VALUES(' + '\"senior\"' + ', ' + arrayForQuery[0] + ', ' + str(personalDataId) + ', ' + defaultSeason + ');\n'
    return query
  return ''

def parsingFile(source, destiny):
  frmIdNumber = '^\d{7},'
  pattern = re.compile(frmIdNumber)
  source.readFile()
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
  sqlHandling = SqlHandling()
  sqlHandling.populateDB(fileGenerated)

def main():
  if len(sys.argv) < 2:
    print "error! Not enough arguments"
    return -1
  pathOfFileToParse = sys.argv[1]
  fileToParse = FileTreatment(pathOfFileToParse)
  pathOfFileGenerated = os.getcwd() + '/' + generateName('.sql')
  fileGenerated = FileTreatment(pathOfFileGenerated)

  if parsingFile(fileToParse, fileGenerated):
    fileGenerated.readFile()
    populateDB(fileGenerated.file)
    fileToParse.deleteFile()
    fileGenerated.deleteFile()
    return 1
  else:
    print 'error! Wrong file'
  return -1
  
main()
