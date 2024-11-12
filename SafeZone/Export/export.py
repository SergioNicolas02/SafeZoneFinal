import pandas as pd
import mysql.connector

# Datos de la conexión
host = 'localhost'
user = 'root'
password = ''
database = 'safezone_db'

# Conectar a la base de datos
conexion = mysql.connector.connect(
    host=host,
    user=user,
    password=password,
    database=database
)

# Consulta SQL para obtener los datos
query = "SELECT * FROM users"

# Leer los datos de la base de datos en un DataFrame de pandas
df = pd.read_sql(query, conexion)

# Guardar el DataFrame en un archivo Excel
df.to_excel('usuarios_safezone.xlsx', index=False)

# Cerrar la conexión
conexion.close()

print("Datos exportados exitosamente a usuarios_safezone.xlsx")
