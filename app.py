from flask import Flask, render_template, request, redirect, url_for, send_from_directory
from flask_mysqldb import MySQL
import os

app = Flask(__name__, template_folder='.')  # Configura la carpeta de plantillas en el mismo directorio

# Configuración de MySQL
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'autoscrud'

mysql = MySQL(app)

# Ruta para servir el archivo CSS
@app.route('/styles.css')
def css():
    return send_from_directory(os.getcwd(), 'styles.css')

@app.route('/')
def index():
    cur = mysql.connection.cursor()
    cur.execute("SELECT * FROM automoviles")
    data = cur.fetchall()
    cur.close()
    return render_template('index.html', automoviles=data)

@app.route('/add', methods=['POST'])
def add_automovil():
    if request.method == 'POST':
        marca = request.form['marca']
        modelo = request.form['modelo']
        anio = request.form['anio']
        precio = request.form['precio']
        cur = mysql.connection.cursor()
        cur.execute("INSERT INTO automoviles (marca, modelo, anio, precio) VALUES (%s, %s, %s, %s)", (marca, modelo, anio, precio))
        mysql.connection.commit()
        return redirect(url_for('index'))

@app.route('/delete/<int:id>')
def delete_automovil(id):
    cur = mysql.connection.cursor()
    cur.execute("DELETE FROM automoviles WHERE id = %s", [id])
    mysql.connection.commit()
    return redirect(url_for('index'))

@app.route('/edit/<int:id>', methods=['GET', 'POST'])
def edit_automovil(id):
    if request.method == 'GET':
        cur = mysql.connection.cursor()
        cur.execute("SELECT * FROM automoviles WHERE id = %s", [id])
        data = cur.fetchone()
        cur.close()
        return render_template('edit.html', automovil=data)
    elif request.method == 'POST':
        marca = request.form['marca']
        modelo = request.form['modelo']
        anio = request.form['anio']
        precio = request.form['precio']
        cur = mysql.connection.cursor()
        cur.execute("""
            UPDATE automoviles
            SET marca = %s, modelo = %s, anio = %s, precio = %s
            WHERE id = %s
        """, (marca, modelo, anio, precio, id))
        mysql.connection.commit()
        return redirect(url_for('index'))

if __name__ == '__main__':
    app.run(debug=True)