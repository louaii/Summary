import http.client
import json
from urllib.parse import quote_plus
base = '/maps/api/geocode/json'
def geocode(address):
    path = '{}?address={}&sensor=false'.format(base, quote_plus(address))
    connection = http.client.HTTPConnection('maps.google.com')
    connection.request('GET', path)
    reply = connection.getresponse().read
    rereply = json.loads(reply.decode('utf-8'))
    print(rereply['results'][0]['geometry']['location'])

if __name__ == '__main__':
    add = '10 Downing St, London SW1A 2AB, UK'
    geocode(add)