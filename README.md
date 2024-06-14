# 02_Matriculas
### Instrucciones para Configurar y Ejecutar la Aplicación

1. **Instalar XAMPP**:
   - Utilice la versión portable de XAMPP incluida en este USB. Navegue a la carpeta `xampp` y ejecute `xampp-control.exe` para iniciar XAMPP.

2. **Iniciar Apache y MySQL**:
   - En el panel de control de XAMPP, inicie `Apache` y `MySQL`.

3. **Importar la Base de Datos**:
   - Abra MySQL Workbench y conéctese al servidor MySQL en ejecución en XAMPP.
   - Vaya a `Server` > `Data Import`.
   - Seleccione `Import from Self-Contained File` y busque el archivo `matriculas.sql` en la carpeta `Proyecto_Matriculas`.
   - Seleccione `Start Import`.

4. **Configurar el Proyecto**:
   - Copie la carpeta `Proyecto_Matriculas` al directorio `htdocs` de XAMPP (`xampp\htdocs`).

5. **Acceder a la Aplicación**:
   - Abra su navegador y vaya a `http://localhost/Proyecto_Matriculas`.

6. **Credenciales de Inicio de Sesión**:
   - Correo Electrónico: hola@hola.com
   - Contraseña: 1234

### Información Adicional

- El proyecto está diseñado para gestionar el registro de vehículos que pueden entrar en el parking de la Universidad Alfonso X el Sabio. Una vez registrado el vehículo, la barrera de entrada se abrirá automáticamente.
- Para más detalles, consulte el manual incluido (`manual_completo_universidad_alfonso_x.pdf`).

