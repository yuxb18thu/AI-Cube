from flask import Flask
from flask import render_template
from flask import request, jsonify
from flask import url_for
import json
import types
import requests
app=Flask(__name__)
# from tools import getResults
from cfop import CFOP
import ast

@app.route('/', methods=['POST','GET'])
def index():
    if request.method == 'GET':
        return render_template('mofang.html')
        # return render_template('../php/index.php')

@app.route('/index.php', methods=['POST','GET'])
def php():
    if request.method == 'GET':
        # return render_template('index.php')
        return render_template('index.php')


@app.route('/initState', methods=['POST'])
def initState():
    if request.method=='POST':
        #rev=request.get_json()['city']
        #result=selcity(rev)
        with open('initState.json', 'r') as f:
            result = json.load(f)
        print(result)
        return jsonify(result)

@app.route('/solve', methods=['POST'])
def solve():
    if request.method == 'POST':
        rev = request.form
        print(rev)
        print("computing...")
        data = rev.to_dict()
        state = []
        data['state'] = ast.literal_eval(data['state'])
        print(data['state'])
        for i in data['state']:
            state.append(int(i))
        print('-------')
        print(state)
        # result = getResults(state)
        url = "http://deepcube.igb.uci.edu/solve"
        # payload='state=[6,46,36,16,4,23,42,5,47,2,39,38,14,13,3,51,32,11,29,30,9,10,22,34,17,48,20,26,1,33,43,31,52,8,50,24,27,7,45,21,40,28,53,25,15,18,41,0,37,49,19,44,12,35]'
        payload='state='+str(state)
        headers = {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
        response = requests.request("POST", url, headers=headers, data=payload)
        print(response.text)
        # result=""
        result=response.text
        print("complete!")
        print(type(result))
        return json.loads(result)

@app.route('/cfop', methods=['POST'])
def solveCFOP():
    if request.method == 'POST':
        rev = request.form
        print(rev)
        print("computing...")
        data = rev.to_dict()
        state = []
        data['state'] = ast.literal_eval(data['state'])
        print(data['state'])
        for i in data['state']:
            state.append(int(i))
        print('-------')
        print(state)
        result=CFOP(state)
        print("complete!")
        print(type(result))
        return jsonify(result)



if __name__=='__main__':
    # app.run(debug=True,host='0.0.0.0',port=5000,ssl_context=('ssl/1.crt','ssl/1.key'))
    app.run(debug=True,host='0.0.0.0',port=5000)