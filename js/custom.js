let forma = document.getElementById('pridetiPreke');

forma.addEventListener('submit', function(e) {
    e.preventDefault();

    let handler = new XMLHttpRequest();
    var data    = new FormData(forma);
    handler.open( 'POST', 'index.php?action=test', false);
    handler.send(data);
    
    console.log(handler.responseText);
});