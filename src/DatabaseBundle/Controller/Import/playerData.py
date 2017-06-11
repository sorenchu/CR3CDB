#!/usr/bin/python

import os
import sys
import string
import random
import re
import MySQLdb

DB_HOST = 'localhost'
DB_USER = 'root'
DB_PASS = 'A.O.egm3sag'
DB_NAME = 'CR3C'

def generateName():
  numOfChars = 10
  return ''.join(random.choice(string.ascii_uppercase) for _ in range(numOfChars))

def readFile(pathToFile):
  return open(pathToFile,'r')

def writeFile():
  extension = '.sql'
  name = generateName() + extension
  return open(name,'a')

def putIntoFile(destiny, string):
  destiny.write(string)

def closeFile(pathToFile):
  return pathToFile.close()

def deleteFile(pathToFile):
  print pathToFile 
  os.remove(pathToFile)

def getPlayerOrCoach(string):
  isSportman = 'Deportista'
  patternSport = re.compile(isSportman)
  if patternSport.search(string):
    return 'player'
  return 'coach'

def getId(arrayForQuery):
  query = 'SELECT id FROM personalData WHERE name = \"' + arrayForQuery[3] + '\" AND surname = \"' + arrayForQuery[4] + '\";'
  connection = openDatabase()
  cursor = connection.cursor()
  cursor.execute(query)
  result = -1 
  if 0 < cursor.rowcount:
    result = cursor.fetchone()[0]
    cursor.close()
    connection.close()
  return result

def exists(id):
  query = 'SELECT id FROM playerData WHERE personalData_id = ' + str(id) + ';'
  connection = openDatabase()
  cursor = connection.cursor()
  cursor.execute(query)
  if 0 < cursor.rowcount:
    cursor.close()
    connection.close()
    return 1
  cursor.close()
  connection.close()
  return 0

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
    return 'cadete'
  else: 
    return 'senior'

def getDefaultSeason():
  query = 'SELECT id FROM season WHERE defaultseason = 1;'
  connection = openDatabase()
  cursor = connection.cursor()
  cursor.execute(query)
  result = cursor.fetchone()[0]
  cursor.close()
  return str(result)

def existsAsPlayerOrCoachData(id, season, table):
  query = 'SELECT id FROM ' + table + ' WHERE personalData_id = ' + str(id) + ' AND season_id = ' + str(season) + ';'
  connection = openDatabase()
  cursor = connection.cursor()
  cursor.execute(query)
  if 0 < cursor.rowcount:
    return cursor.fetchone()[0]
  return -1


# TODO: it is needed to include an option for updating tables instead inserting
def insertIntoPlayerOrCoachData(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  personalDataId = getId(arrayForQuery)
  defaultSeason = getDefaultSeason()
  if -1 != personalDataId:
    if 'player' == getPlayerOrCoach(string):
      exists = existsAsPlayerOrCoachData(personalDataId, defaultSeason, 'playerData')
      if -1 != exists:
        query = 'UPDATE playerData SET category = \"' + getCategory(arrayForQuery[7]) + '\", number = ' + arrayForQuery[0] + ', personalData_id= ' + str(personalDataId) + ', season_id = ' + str(defaultSeason) + ' WHERE id = ' + str(exists) + ';\n'
      else:
        query = 'INSERT INTO playerData(category, number, personalData_id, season_id) '
        query += 'VALUES(\"' + getCategory(arrayForQuery[7]) + '\", ' + arrayForQuery[0] + ', ' + str(personalDataId) + ', ' + defaultSeason + ');\n'
    else:
      exists = existsAsPlayerOrCoachData(personalDataId, defaultSeason, 'playerData')
      if -1 != exists:
        query = 'UPDATE coachData SET category = \"' + getCategory(arrayForQuery[7]) + '\", number = ' + arrayForQuery[0] + ', personalData_id= ' + str(personalDataId) + ', season_id = ' + str(defaultSeason) + ' WHERE id = ' + str(exists) + ';\n'
      else:
        query = 'INSERT INTO coachData(category, number, personalData_id, season_id) '
        query += 'VALUES(' + '\"senior\"' + ', ' + arrayForQuery[0] + ', ' + str(personalDataId) + ', ' + defaultSeason + ');\n'
    return query
  return ''

def parsingFile(source, destiny):
  frmIdNumber = '^\d{7},'
  pattern = re.compile(frmIdNumber)
  for line in source:
    if pattern.search(line):
      sqlQuery = alterPersonalData(line)
      putIntoFile(destiny, sqlQuery)
      sqlQuery = insertIntoPlayerOrCoachData(line)
      putIntoFile(destiny, sqlQuery)
  return 1 

def openDatabase():
  return MySQLdb.connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)

def populateDB(fileGenerated):
  connection = openDatabase()
  cursor = connection.cursor()
  for line in fileGenerated:
    cursor.execute(line)
  connection.commit()
  cursor.close()
  connection.close()

def main():
  if len(sys.argv) < 2:
    print "error! Not enough arguments"
    return -1
  pathOfFileToParse = sys.argv[1]
  fileToParse = readFile(pathOfFileToParse)
  fileGenerated = writeFile();
  if parsingFile(fileToParse, fileGenerated):
    pathOfFileGenerated = os.getcwd() + '/' + fileGenerated.name
    closeFile(fileGenerated)
    fileGenerated = readFile(pathOfFileGenerated)
    populateDB(fileGenerated)
    deleteFile(pathOfFileToParse)
    deleteFile(pathOfFileGenerated)
    return 1
  closeFile(fileToParse)
  closeFile(fileGenerated)
  return -1
  
main()
