#!/usr/bin/python
#
# Copyright (C) 2009 Thomas Cort <tcort@tomcort.com>
#
# This file is part of scurrility.
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.

from SOAPpy import WSDL
# SOAPpy is available under a permissive license at the following URL:
# http://pywebsvcs.sourceforge.net/ or the gNewSense package python-soappy

def filter(msg):
	WSDLFile = 'scurrility.wsdl'
	return WSDL.Proxy(WSDLFile).Scurrility(msg)

def getSourceCode():
	WSDLFile = 'scurrility.wsdl'
	return WSDL.Proxy(WSDLFile).GetSourceCode('server')

def getVersion():
	WSDLFile = 'scurrility.wsdl'
	return WSDL.Proxy(WSDLFile).GetVersion('server')

print filter('go to hell')
print getSourceCode()
print getVersion()
