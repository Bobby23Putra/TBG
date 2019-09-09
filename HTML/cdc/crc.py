#!/usr/bin/env python

import sys

x=0x2D4
val = (0xffff - (x % 0x10000)) + 1
print hex(val)[2:]
