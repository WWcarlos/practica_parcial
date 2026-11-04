from flask import Flask, jsonify
import mysql.connector

app = Flask(__name__)

@app.route("/")
def inicio():
    db = mysql.connector.connect(
        host="mysql",
        user="root",
        password="clave",
        database="prueba"
    )
    cur = db.cursor()
    cur.execute("SELECT NOW()")
    fila = cur.fetchone()
    cur.close()
    db.close()
    return jsonify({"hora": str(fila[0])})

app.run(host="0.0.0.0", port=5000)
