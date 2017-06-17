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

def readFile(pathToFile):
  return open(pathToFile,'r')

def getSex(string):
  isMale = 'Masculino'
  patternSex = re.compile(isMale)
  if patternSex.search(string):
    return 'male'
  return 'female'

def getSql(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  dni = arrayForQuery[1]
  if '' == dni:
    dni = str(random.randint(0,150000))
  query = 'INSERT INTO personalData(name, surname, sex, dni, is_player, is_coach, is_parent, is_member)'
  query += ' VALUES(\"' + arrayForQuery[2] + '\", \"' + arrayForQuery[3] + '\", \"' + getSex(string) + '\", \"' + dni + '\", 0, 0, 0, 0);\n'
  return query

def parsingFile(source, destiny):
  # This regex checks for a single number and them it has three choices: empty string, Spanish id or Non-Spanish id
  # TODO: not working with empty strings
  properLine = '^\d{1,7},(,|\d{8}[A-Z]|[A-Z]\d{7}[A-Z])'
  pattern = re.compile(properLine)
  correctFile = 0
  source.readFile()
  destiny.editFile()
  for line in source.file:
    if pattern.search(line):
      correctFile = 1
      sqlQuery = getSql(line)
      destiny.writeIntoFile(sqlQuery)
  return correctFile

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

  if 1 == parsingFile(fileToParse, fileGenerated):
    fileGenerated.closeFile()
    fileGenerated.readFile()
    populateDB(fileGenerated.file)
    #fileToParse.deleteFile()
    fileGenerated.deleteFile()
    return 1
  else:
    print 'error! Wrong file'
  return -1

main()
