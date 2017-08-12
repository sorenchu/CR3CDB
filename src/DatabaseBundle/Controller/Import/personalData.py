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

def getSex(string):
  isMale = 'Masculino'
  patternSex = re.compile(isMale)
  if patternSex.search(string):
    return 'male'
  return 'female'

def existPersonInDatabase(name, surname):
  sqlHandling = SqlHandling()
  sqlHandling.establishConnection()
  query = 'SELECT name, surname FROM personalData WHERE name = \"'  + name + '\" AND surname = \"' + surname + '\";\n'
  sqlHandling.sendQuery(query)
  data = sqlHandling.getRowCount()
  if data > 0:
    return 0
  return 1

def getSql(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  dni = arrayForQuery[1]
  name = arrayForQuery[2]
  surname = arrayForQuery[3]
  # If there is no dni for a person, we check if he or she exists
  # with name and surname. If it does, we consider that already exists
  if '' == dni and 1 == existPersonInDatabase(name, surname):
    dni = str(random.randint(0,150000))

  query = ''
  if '' != dni:
    query = 'INSERT INTO personalData(name, surname, sex, dni, is_player, is_coach, is_parent, is_member)'
    query += ' VALUES(\"' + name + '\", \"' + surname + '\", \"' + getSex(string) + '\", \"' + dni + '\", 0, 0, 0, 0);\n'
  else:
    print 'Error! Duplicated person for ' + name + ' ' + surname
  return query

def parsingFile(source, destiny):
  # This regex checks for a single number and them 
  # it has three choices: empty string, Spanish id or Non-Spanish id
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
  source.closeFile()
  destiny.closeFile()
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
    fileGenerated.readFile()
    populateDB(fileGenerated.file)
    fileToParse.deleteFile()
    fileGenerated.deleteFile()
    return 1
  else:
    print 'error! Wrong file'
  return -1

main()
