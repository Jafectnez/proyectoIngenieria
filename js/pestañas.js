//Arreglos de control
var tabLinks = new Array();
var contentDivs = new Array();

function init() {

    //Se obtienen las pestañas y los contenidos de la página.
    var tabListItems = document.getElementById('myTab').childNodes; //mytab hace referencia al id del <ul> que contiene las pestañas
    for ( var i = 0; i < tabListItems.length; i++ ) {
        if ( tabListItems[i].nodeName == "LI" ) {
            var tabLink = getFirstChildWithTagName( tabListItems[i], 'A' );
            var id = getHash( tabLink.getAttribute('href') );
            tabLinks[id] = tabLink;
            contentDivs[id] = document.getElementById( id );
        }
    }

    //Se asignan eventos "onclick" a cada pestaña y
    //Se enfatiza la primer pestaña.
    var i = 0;
    for ( var id in tabLinks ) {
        tabLinks[id].onclick = function showTab() {
            var selectedId = getHash( this.getAttribute('href') );
        
            //Se enfatiza la pestaña seleccionada y se quita el enfatizado (si lo hubiera) a las otras.
            //También se muestra el contenido del div seleccionado, escondiendo los otros.
            for ( var id in contentDivs ) {
                if ( id == selectedId ) {
                    tabLinks[id].className = 'selected';
                    contentDivs[id].className = 'tabContent';
                    document.getElementById(id+"-li").className = 'pestaña-selected';
                } else {
                    tabLinks[id].className = '';
                    contentDivs[id].className = 'tabContent hide';
                    document.getElementById(id+"-li").className = '';
                }
            }
        
            //Se deteniene el navegador de seguir buscando el link de la pestaña.
            return false;
        };

        //Se agrega un efecto cuando el mouse pasa por encima de la pestaña
        tabLinks[id].onfocus = function() { this.blur() };

        //Se busca la primer pestaña para que sea cargada sin necesidad de hacerle click
        if( i == 0 ){
            tabLinks[id].className = 'selected';
            contentDivs[id].className = 'tabContent';
            document.getElementById(id+"-li").className = 'pestaña-selected';
            i=1
        }
    }

    //Se esconde todo el contenido de los divs excepto el primero.
    var i = 0;

    for ( var id in contentDivs ) {
        if ( i != 0 ) contentDivs[id].className = 'tabContent hide';
        i++;
    }
}

function getFirstChildWithTagName( element, tagName ) {
    //Se obtiene el primer hijo de una etiqueta que tenga el "tagName" del parametro (en este caso, los <a>)
    for ( var i = 0; i < element.childNodes.length; i++ ) {
        if ( element.childNodes[i].nodeName == tagName ) return element.childNodes[i];
    }
}

function getHash( url ) {
    //Se obtiene el valor del "href" para obtener el id del div de contenido respectivo
    var hashPos = url.lastIndexOf ( '#' );
    return url.substring( hashPos + 1 );
}