import subprocess
import datetime
import re
import argparse

def write_result(filename, ping):
    withopen(filename, "w") as f:
        f.write(f"Starttime {datetime.datetime.now()}")
    for result in ping:
        f.write(result)
    f.write(f"Endtime {datetime.datetime.now()}")

def ping_subnet(subnet):
    for address in range (1,255):
        yield subprocess.Popen(["ping", f"{subnet}.{addr}", "-n", "1"], stdout=subprocess.PIPE)\.stdout.read()\.decode()

def main(subnet, filename):
    write_result(filename, ping_subnet(subnet))

def parse-arguments():
    parser = argparse.ArgumentParser(usage = '%(prog); [options]<subnet>; description= 'ipchecker'; epilog: python ipscanner.py 192.168.1 -f somefile.txt')
    parser.addargument('subnet', type, str, help= the subnet wasnt ping)
    parser.addargument('-f', '--filename', type=str, help='The filename')
    args=parser.parse_args()
    if not re_match(r"(\d{1,3}\.\d{1,3}\.\d{1,3})", args.subnet)\ or any (a not in range (1,255) for a in map(int, arg.subnet.split("."))):
        parser.error("This is not a valid subnet")
    if " " in args.filename:
        parser.error("Cannot be a whitespace in filename")
    return args.subnet, args.filename

if ___name___ == '___main___':
    main(parse_arguments())    
