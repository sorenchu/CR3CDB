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

def getSex(string):
  isMale = 'Masculino'
  patternSex = re.compile(isMale)
  if patternSex.search(string):
    return 'male'
  return 'female'

def getCategory(string):
  isSportman = 'Deportista'
  patternSport = re.compile(isSportman)
  if patternSport.search(string):
    return 'player'
  return 'coach'

def getSql(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  if 'player' == getCategory(string):
    query = 'INSERT INTO personalData(name, surname, sex, is_player, is_coach, is_parent, is_member) '
  else:
    query = 'INSERT INTO personalData(name, surname, sex, is_coach, is_player, is_parent, is_member) '
  query += 'VALUES(\"' + arrayForQuery[3] + '\", \"' + arrayForQuery[4] + '\", \"' + getSex(string) + '\", 1, 0, 0, 0);\n'
  return query

def parsingFile(source, destiny):
  regularExpression = '^\d{7},'
  pattern = re.compile(regularExpression)
  for line in source:
    if pattern.search(line):
      sqlQuery = getSql(line)
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
  if (parsingFile(fileToParse, fileGenerated)):
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
