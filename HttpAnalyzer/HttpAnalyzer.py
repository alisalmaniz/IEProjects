import sys
import requests

url = sys.argv[1]


def main():
    try:
        result = requests.get(url)
        print('Server Application:')
        if str(result.headers).find('Server') > -1:
            print('\t', result.headers['server'])
        else:
            print('\tNot Mentioned')

        print('Allowed Methods:')
        print_allow_methods()

        print('Cookies:')
        print_cookies()

        print('Cache:')
        print_cache()

        print('Authentication:')
        result = requests.get(url)
        if str(result.headers).find('WWW-Authenticate') > -1:
            aut = str(result.headers['WWW-Authenticate'])
            print('\t', aut.split(' ')[0])
        else:
            print('\tNo')

        print('Success/Error Code:')
        print_response_code()

        print('Allow Persistent Connections:')
        result = requests.head(url)
        if str(result.headers).find('Connection') > -1:
            p = str(result.headers['Connection'])
            if p.find('Keep-Alive') > -1:
                print('\tYes')
            else:
                print('\tNo')
        else:
            print('\tNot Mentioned')

    except:
        print('URL Error')

    return


def print_allow_methods():
    result = requests.get(url)
    if str(result).find('405') == -1:
        print('\t', 'get')
    result = requests.head(url)
    if str(result).find('405') == -1:
        print('\t', 'head')
    result = requests.post(url)
    if str(result).find('405') == -1:
        print('\t', 'post')
    result = requests.delete(url)
    if str(result).find('405') == -1:
        print('\t', 'delete')
    result = requests.put(url)
    if str(result).find('405') == -1:
        print('\t', 'put')
    result = requests.options(url)
    if str(result).find('405') == -1:
        print('\t', 'options')
    return


def print_cookies():
    result = requests.get(url)
    if str(result.headers).find('Set-Cookie') > -1:
        cookies_nv = result.cookies.items()
        cookie = str(result.headers['Set-Cookie'])
        index = []
        cookies = []
        for name, value in cookies_nv:
            index.append(cookie.find(name))
        for i in range(0, len(index)):
            if i == len(index)-1:
                cookies.append(cookie[index[i]:])
            else:
                cookies.append(cookie[index[i]:index[i+1]])

        for c in cookies:
            print('\t', c)
            if c.find('; ') > -1:
                nvs = c.split('; ')
                print('\t\tname =', nvs[0].split('=')[0])
                print('\t\tvalue =', nvs[0].split('=')[1])
                for nv in nvs:
                    i = nv.find('Expires=')
                    if i > -1:
                        print('\t\tExpires =', nv[i + 8:])
                    i = nv.find('expires=')
                    if i > -1:
                        print('\t\texpires =', nv[i + 8:])
                    i = nv.find('Max-Age=')
                    if i > -1:
                        print('\t\tMax-Age =', nv[i + 8:])
                    i = nv.find('max-age=')
                    if i > -1:
                        print('\t\tmax-age =', nv[i + 8:])
                    i = nv.find('Path=')
                    if i > -1:
                        print('\t\tPath =', nv[i + 5:])
                    i = nv.find('path=')
                    if i > -1:
                        print('\t\tpath =', nv[i + 5:])
                    i = nv.find('Domain=')
                    if i > -1:
                        print('\t\tDomain =', nv[i + 7:])
                    i = nv.find('domain=')
                    if i > -1:
                        print('\t\tdomain =', nv[i + 7:])

                i = c.find('Secure')
                if i > -1:
                    print('\t\tsecure = yes')
                else:
                    print('\t\tsecure = no')
                i = c.find('HttpOnly')
                if i > -1:
                    print('\t\thttpOnly = yes')
                else:
                    print('\t\thttpOnly = no')

            else:
                print('\t\tname =', c.split('=')[0])
                print('\t\tvalue =', c.split('=')[1])
    else:
        print('\tNo Cookie.')
    return


def print_response_code():
    result = requests.get(url)
    if str(result).find('200') > -1:
        print('\t200 = Successful: OK')
    elif str(result).find('201') > -1:
        print('\t201 = Successful: Created')
    elif str(result).find('400') > -1:
        print('\t400 = Client error: Bad request')
    elif str(result).find('401') > -1:
        print('\t401 = Client error: Unauthorized')
    elif str(result).find('403') > -1:
        print('\t403 = Client error: Forbidden')
    elif str(result).find('404') > -1:
        print('\t404 = Client error: Not found')
    elif str(result).find('405') > -1:
        print('\t405 = Client error: Not allowed method')
    elif str(result).find('500') > -1:
        print('\t500 = Server Error: Internal server error')
    elif str(result).find('501') > -1:
        print('\t501 = Server Error: Not implemented')
    elif str(result).find('503') > -1:
        print('\t503 = Server Error: Service unavailable')
    elif str(result).find('301') > -1:
        print('\t301 = Moved Permanently')
    elif str(result).find('304') > -1:
        print('\t304 = Not modified')

    return


def print_cache():
    result = requests.get(url)
    if str(result.headers).find('Cache-Control') > -1:
        cc = str(result.headers['Cache-Control'])
        print('\tCache Control = ', cc)
    else:
        print('\tCache Control = Not Mentioned')
    if str(result.headers).find('Expires') > -1:
        ex = str(result.headers['Expires'])
        print('\tExpires = ', ex)
    else:
        print('\tExpires = Not Mentioned')
    if str(result.headers).find('Last-Modified') > -1:
        lm = str(result.headers['Last-Modified'])
        print('\tLast Modified = ', lm)
    else:
        print('\tLast Modified = Not Mentioned')

    return
# header = str(result.headers)

'''
headers = header.split(', ')
for h in headers:
    print(h)
'''

if __name__ == '__main__':
    main()
