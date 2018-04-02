#!/usr/bin/python
import cgi, cgitb


form = cgi.FieldStorage()
year = form.getvalue('Year')
form_type = form.getvalue('format')
y = int(year)

def suffix(p):
    if (p == 1 or p == 21 or p == 31):
        return "st"
    if (p == 3 or p == 23):
        return "rd"
    if (p == 2 or p == 22):
        return "nd"
    else:
        return "th"

def months(n):
    if (n == 3):
        return "March"
    else:
        return "April"
        
def form(form_type, p, n, y):
    if form_type == "numerically":
        return str(p) + "/" + str(n) + "/" + str(y)
    elif form_type == "verbosely":
        return str(p) + suffix(p) + " of " + months(n) + " " + str(y) 
    else:
        return str(p) + suffix(p) + " of " + months(n) + " " + str(y) + " (" +str(p) + "/" + str(n) + "/" + str(y) + ")"
    
a = y % 19
b = y // 100
c = y % 100
d = b // 4
e = b % 4
g = (8 * b + 13) // 25
h = (19 * a + b - d - g + 15) % 30
j = c // 4
k = c % 4
m = (a + 11 * h) // 319
r = (2 * e + 2 * j - k - h + m + 32) % 7
n = (h - m + r + 90) // 25
p = (h - m + r + n + 19) % 32
        
print("Content-Type: text/html; charset=utf-8")
print("")
print("<!DOCTYPE html>")
print("<html>")
print("<head> <title> Finding Easter </title> <link href = '../cssfe.css' rel = 'stylesheet' /> </head>")
print("<body>")
print("<br /><br />")
print("<br /><br />")
print("<br /><br />")
print("<h2> Easter Falls on: </h2> <br /><br />")
print("<h3>" + form(form_type, p, n, y) + "</h3>")
print("<footer>")
print("Thank you for using this website")
print("</footer>")
print("</body>")
print("</html>")
