From scapy.all import ARP, Ether, srp
#socket is an endpoint for communication between two devices over network, allows program to establish network connections (send/recieve data, perform network operations)

import socket
#function get_local_ip_address():
#socket.AF_INET stands for ipv4 network communication
#socket.SOCK_DGRAM used as UDP transport protocol
#connect is from object sock to establish a connection to a remote endpoint
#socket.connect('8.8.8.8', 80) is to the public ip 8.8.8.8 over the http port number 80
#socket.getsockname()[0] to get the ip address return at index[0]
#socket.gethostbyname() is to perform DNS resolution and returns the ip address as obtained with hostname
#socket.error() if error occured 
#socket.close() to close the correction



def get_local_ip_address():
	sock=socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
	try:
		sock.connect(('8.8.8.8', 80))
		local_ip_address = sock.getsockname()[0]
	except socket.error:
		local_ip_address = socket.gethostname(socket.gethostname())
	finally:
		sock.close()
	return local_ip_address
#This function to get your ip
#get_network_hosts():
#rfind(''): takes a parameter and looks for it till the end and takes it.
#Here is an example: it will look for your ip (192.168.1.3) ==> will leave the last octet as remainder and goes with the 192.168.1 + '.0/24' as subnet 255.255.255.0

#pdst: specify the target ip address or network for the arp operation
#ether: Ether(dst='ff:ff:ff:ff:ff:ff')
#dst is for destination mac address
#packet = ether/arp #in scapy lib layers order eth12 arp 13
#result = srp(packet, timeout=3, verbose=0)[0]

#Control the level of verbosity during packet sending and receiving 0=none

def get_network_hosts():
	local_ip_address = get_local_ip_address()
	network = local_ip_address[:local_ip_address.rfind('.')] + '.0/24'
	arp = ARP(pdst = network)
	ether = Ether(dst = 'ff:ff:ff:ff:ff:ff')
	packet = ether/arp
	result = srp(packet, timeout = 3, verbose = 0)[0]
	hosts = []
	for recieved in result
		hosts.append(received.psrc)
	return hosts
