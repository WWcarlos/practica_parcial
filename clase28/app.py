from flask import Flask,jsonify

app = Flask(__name__)
@app.route("/ejemplo")

def ejemplo ():
    return jsonify({
        "mensaje":"Hola desde la API"
    })

app.run(host="0.0.0.0", port=5007)
