#!/usr/bin/python

import logging
import datetime
import os

class Logging:
    def __init__(self, logLevel = 'info'):
        self.initLogging(logLevel)

    def initLogging(self, logLevel = 'info'):
        today = str(datetime.date.today())
        today = today.replace("-","")
        filename = os.path.join(os.getcwd(), '.playerdata-%s.log' % (today))
        if logLevel == 'debug':
          logging.basicConfig(filename='%s' % (filename), level=logging.DEBUG)
        elif logLevel == 'info':
          logging.basicConfig(filename='%s' % (filename), level=logging.INFO)

    def logInfo(self, string):
        logging.info('%s - %s' % (datetime.datetime.now().strftime('%H:%M'), string))
    
    def logDebug(self, string):
        logging.debug('%s - %s' % (datetime.datetime.now().strftime('%H:%M'), string))
