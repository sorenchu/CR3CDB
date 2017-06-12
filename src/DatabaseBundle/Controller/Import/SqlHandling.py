#!/usr/bin/python

import MySQLdb

DB_HOST = 'localhost'
DB_USER = 'root'
DB_PASS = 'A.O.egm3sag'
DB_NAME = 'CR3C'

class SqlHandling:
  connection = ""
  cursor = ""

  def __init__(self):
    self.data = []

  def openDatabase(self):
    return MySQLdb.connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)

  def establishConnection(self):
    self.connection = self.openDatabase()
    self.connection.set_character_set('utf8')
    self.cursor = self.connection.cursor()

  def sendQuery(self, string):
    try:
      self.cursor.execute(string)
    except self.cursor.IntegrityError as err:
      print 'Error: {}'.format(err)

  def fetchOneData(self):
    return self.cursor.fetchone()[0]

  def getRowCount(self):
    return self.cursor.rowcount

  def commit(self):
    self.connection.commit()

  def populateDB(self, fileGenerated):
    self.establishConnection()
    for line in fileGenerated:
      self.sendQuery(line)
    self.commit()
    self.closeConnection()

  def closeConnection(self):
    self.cursor.close()
    self.connection.close()
  
