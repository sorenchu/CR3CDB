#!/usr/bin/python

import os

class FileTreatment:
  name = ""

  def __init__(self, name):
    self.name = name

  def readFile(self):
    self.file = open(self.name, 'r')

  def editFile(self):
    self.file = open(self.name, 'a')

  def writeIntoFile(self, string):
    self.file.write(string)
  
  def closeFile(self):
    self.file.close()

  def deleteFile(self):
    os.remove(self.name)
