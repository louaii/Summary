import requests
def geocode(address):
    parameters = ['address': address, 'sensor':'false']
    base = 'http://maps.googleapis.com/maps/api/geocode/json'
    response = requests.get(base, params=parameters)
    result = response.json()
    print(result['results'][0]['geometry']['location'])

if __name__ == '__main__':
    add = '10 Downing St, London SW1A 2AB, UK'
    geocode(add)
    