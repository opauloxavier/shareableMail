import sys

def descadastra(value):
	database = "hm_rn_usuarios"
	string = "select * from %s where email = '%s'" % (database, sys.argv[1])

	print "-"*20

	for i in range(2,len(sys.argv)):
		string+="or email='%s'" %sys.argv[i]

	string+=";"
	print string

	print "-"*20

descadastra(sys.argv)