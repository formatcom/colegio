function notas(){
    this.maestro  = document.getElementById('maestro');
    this.materia;
    this.id_maestro;
    this.id_grado;
    this.id_materia;
    this.lista;
    
    this.setMaestro();
}

notas.prototype.setMaestro=function(){
    self = this;
    this.maestro.onclick=function(){
        self.id_maestro = document.getElementById('id_maestro').value;
        var mapeado = self.id_maestro.split("|");
        self.id_maestro = mapeado[0];
        self.id_grado = mapeado[1];
        self.maestrophp();
    };
}

notas.prototype.setMateria=function(){
    self = this;
    this.materia.onclick=function(){
        self.id_materia = document.getElementById('id_materia').value;
        self.materiaphp();
    };
}

notas.prototype.masNotas=function(){
    add('<br/><input name="notas[]" placeholder="Nota"/> <input name="pesos[]" placeholder="Peso"/><input type="button" value="Agregar" onClick="formulario.masNotas();"/>', true, 'mostrarNotas');
}

notas.prototype.get=function(atributo){
    switch(atributo){
        case "maestro":
            return this.id_maestro;
        case "grado":
            return this.id_grado;
        case "materia":
            return this.id_materia;
    }
}

notas.prototype.maestrophp=function(){
    var direccion = "funciones/php/consultas.php?consulta=2&grado="+this.id_grado;
    self = this;
    $.ajax({
        url: direccion,
        dataType: 'JSON',
        success: function(data){
            self.lista = "";
            for (var i = 0; i < data.length; i++){
                self.lista +=data[i];
            }
            self.lista = '<select name="materia" id="id_materia">' + self.lista + '</select>';
            add(self.lista+'<input type="button" value="Elegir" id="materia" />', false, 'mostrarMaterias');
            self.materia  = document.getElementById('materia');
            self.setMateria();
        },
        error: function(){ alert('error 404'); }
    });
}

notas.prototype.materiaphp=function(){
    var direccion = "funciones/php/consultas.php?consulta=3&grado="+this.id_grado+"&materia="+this.id_materia;
    self = this;
    $.ajax({
        url: direccion,
        dataType: 'JSON',
        success: function(data){
            self.lista = "";
            for (var i = 0; i < data.length; i++){
                self.lista +=data[i];
            }
            self.lista = '<select name="estudiante">' + self.lista + '</select>';
            add(self.lista, false, 'mostrarEstudiantes');
            add('<input name="notas[]" placeholder="Nota"/> <input name="pesos[]" placeholder="Peso"/><input type="button" value="Agregar" onClick="formulario.masNotas();"/>', false, 'mostrarNotas');
        },
        error: function(){ alert('error 404'); }
    });
}

function add(html,nueva, id){
    var capa=document.getElementById(id);
    if (nueva)
        capa.innerHTML+=html;
    else
        capa.innerHTML=html;
}