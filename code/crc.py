#!/usr/bin/env python

import sys

x=0x2FC
val = (0xffff - (x % 0x10000)) + 1
print hex(val)[2:]
