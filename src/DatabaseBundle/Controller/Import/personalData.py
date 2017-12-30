#!/usr/bin/python

import os
import sys
import string
import random
import re
from datetime import datetime

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

def insertIntoContact(data):
    sqlHandling = SqlHandling()
    sqlHandling.establishConnection()
    query = 'SELECT id FROM personalData WHERE dni = \"' + data['dni'] + '\";\n'
    sqlHandling.sendQuery(query)
    id = sqlHandling.fetchOne()
    print("phone: %s" % (data['phone'] == ""))
    print("id: %s" % id)
    if id != None:
        query = 'INSERT INTO contactData(address, city, zipcode, phone, email, personalData_id)'
        query += ' VALUES('
        if data['address'] == "":
            query += 'NULL, '
        else:
            query += '\"%s\",' % (data['address'])

        if data['city'] == "":
            query += 'NULL, '
        else:
            query += '\"%s\",' % (data['city'])
        
        if data['zipcode'] == "":
            query += 'NULL, '
        else:
            query += '%s, ' % (data['zipcode'])

        if data['phone'] == "":
            query += 'NULL, '
        else:
            query += '%s, ' % (data['phone'])

        if data['email'] == "":
            query += 'NULL, '
        else:
            query += '\"%s\", ' % (data['email'])

        query += '%d);\n' % (id[0])
        #query += ' VALUES(\"%s\", \"%s\", %s, %s, %s, %d);\n' % (data['address'], data['city'], data['zipcode'], data['phone'], data['email'], id[0])
        return query
    return ""

def getPersonalData(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  data = {'number'   : arrayForQuery[0],
          'dni'      : arrayForQuery[1],
          'name'     : arrayForQuery[2],
          'surname'  : arrayForQuery[3],
          'address'  : arrayForQuery[4],
          'city'     : arrayForQuery[5],
          'zipcode'  : arrayForQuery[6],
          'phone'    : arrayForQuery[7],
          'phone'    : arrayForQuery[8],
          'email'    : arrayForQuery[9],
          'birthdate': arrayForQuery[12],
          'sex'      : arrayForQuery[13]
  }
  print(data)
  # If there is no dni for a person, we check if he or she exists
  # with name and surname. If it does, we consider that already exists
  if '' == data['dni'] and 1 == existPersonInDatabase(data['name'], data['surname']):
    data['dni'] = str(random.randint(0,150000))

  query = ''
  if '' != data['dni']:
    if data['birthdate'] == "":
        data['birthdate'] = "NULL"
    else:
        data['birthdate'] = str(datetime.strptime(data['birthdate'], '%d-%m-%Y'))
    query = 'INSERT INTO personalData(name, surname, sex, dni, birthday, is_player, is_coach, is_parent, is_member)'
    query += ' VALUES(\"' + data['name'] + '\", \"' + data['surname'] + '\", \"' + getSex(data['sex']) + '\", \"' + data['dni'] + '\", "' + data['birthdate'] + '", 0, 0, 0, 0);\n'
  else:
    print 'Error! Duplicated person for ' + data['name'] + ' ' + data['surname']
  return query

def getContactData(string):
  splitting = ','
  arrayForQuery = string.split(splitting)
  data = {'number'   : arrayForQuery[0],
          'dni'      : arrayForQuery[1],
          'address'  : arrayForQuery[4],
          'city'     : arrayForQuery[5],
          'zipcode'  : arrayForQuery[6],
          'phone'    : arrayForQuery[7],
          'phone'    : arrayForQuery[8],
          'email'    : arrayForQuery[9]
  }
  query = insertIntoContact(data)
  if query == "":
        print("Error with data %s " % (data['dni']))
        return ""
  else:
        return query

def parsingPersonalData(source, destiny, contact=False):
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
      if contact == False:
        personalDataQuery = getPersonalData(line)
      else:
        personalDataQuery = getContactData(line)
      if personalDataQuery != "":
        destiny.writeIntoFile(personalDataQuery)
  source.closeFile()
  destiny.closeFile()
  return correctFile

def populateDB(fileGenerated):
  sqlHandling = SqlHandling()
  sqlHandling.populateDB(fileGenerated)

def main():
  if len(sys.argv) < 2:
    print "error! Not enough arguments\nUsage: python personalData.py file.csv"
    return -1

  pathOfFileToParse = sys.argv[1]
  fileToParse = FileTreatment(pathOfFileToParse)
  pathOfFileGenerated = os.getcwd() + '/' + generateName('.sql')
  personalDataGenerated = FileTreatment(pathOfFileGenerated)
  if 1 == parsingPersonalData(fileToParse, personalDataGenerated):
    personalDataGenerated.readFile()
    populateDB(personalDataGenerated.file)
    personalDataGenerated.deleteFile()

    pathOfFileGenerated = os.getcwd() + '/' + generateName('.sql')
    contactDataGenerated = FileTreatment(pathOfFileGenerated)
    parsingPersonalData(fileToParse, contactDataGenerated, True)
    contactDataGenerated.readFile()
    populateDB(contactDataGenerated.file)
    fileToParse.deleteFile()
    contactDataGenerated.deleteFile()
    return 1
  else:
    print 'error! Wrong file'
  return -1

main()
