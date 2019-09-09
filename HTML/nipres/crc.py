#!/usr/bin/env python
x=0x2D1
val = (0xffff - (x % 0x10000)) + 1
print hex(val)[2:]
