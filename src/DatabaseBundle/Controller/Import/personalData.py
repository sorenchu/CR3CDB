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

def getSql(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  query = 'INSERT INTO personalData(name, surname, sex, dni, is_player, is_coach, is_parent, is_member)'
  query += 'VALUES(\"' + arrayForQuery[2] + '\", \"' + arrayForQuery[3] + '\", \"' + getSex(string) + '\", \"' + arrayForQuery[1] + '\", 0, 0, 0, 0);\n'
  return query

def parsingFile(source, destiny):
  # This regex checks for a single number and them it has three choices: empty string, Spanish id or Non-Spanish id
  properLine = '^\d{1,7},(,|\d{8}[A-Z]|[A-Z]\d{7}[A-Z])'
  pattern = re.compile(properLine)
  correctFile = 0
  for line in source:
    if pattern.search(line):
      correctFile = 1
      sqlQuery = getSql(line)
      putIntoFile(destiny, sqlQuery)
  return correctFile 

def openDatabase():
  return MySQLdb.connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)

def populateDB(fileGenerated):
  connection = openDatabase()
  cursor = connection.cursor()
  for line in fileGenerated:
    try:
      cursor.execute(line)
    except cursor.IntegrityError as err:
      print 'Error: {}'.format(err)
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
  if 1 == parsingFile(fileToParse, fileGenerated):
    pathOfFileGenerated = os.getcwd() + '/' + fileGenerated.name
    closeFile(fileGenerated)
    fileGenerated = readFile(pathOfFileGenerated)
    populateDB(fileGenerated)
    deleteFile(pathOfFileToParse)
    deleteFile(pathOfFileGenerated)
    return 1
  else:
    print 'error! Wrong file'
  closeFile(fileToParse)
  closeFile(fileGenerated)
  return -1
  
main()
