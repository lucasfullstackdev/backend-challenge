
$( document ).ready( () => {
    const matrixContainer = $('#matrix-container');
    const btnOrderMatrix = $('#order-matrix');

    const btnGenerateMatrix = $('#btn-generate-matrix');
    const btnCalculate = $('#btn-calculate');

    const result = $('#result span');

    let order = null;
    let matrix = {};

    const validateOrder = () => {
        order = btnOrderMatrix.val();
        return ( isNaN(order) || order <= 0 ) ? false: true; 
    };


    const randomValue = () => {
        let seconds = new Date().getSeconds();

        return Math.floor( Math.random() * seconds );
    };

    const generateMatrix = () => {
        if ( !validateOrder() ) return alert( 'Ops! informe um valor válido! O valor precisa ser um número mair que zero' );
        
        let aux = [];
        matrix = {};

        for ( let i = 0; i < order; i++ ){
            aux = [];
            for ( let j = 0; j < order; j++ ){
                aux.push(j);
            }
            matrix[ i ] = aux;
        }

        matrixContainer.empty();
        let width = 100 / order;

        for ( let row in matrix ){
            matrix[row].forEach( col => {
                randomValue();

                matrixContainer.append( `<div class="container-field-matrix flex-center" style="width: ${width}%; ">\
                    <input name='row-${row}-col-${col}' row='${row}' col='${col}' value='${randomValue()}'/>\
                </div>` );
            });
        }
    };
    
    const calculate = () => {
        let mainDiagonal = 0;
        let secondaryDiagonal = 0;

        for ( let row in matrix ){
            row = Math.abs(row);
            
            matrix[row].forEach( col => {
                col = Math.abs(col);
                let currentInputValue = Math.abs( $(`input[name='row-${row}-col-${col}']`).val() );

                if ( row == col )
                    mainDiagonal = mainDiagonal + currentInputValue;

                if ( (row + col) == (order - 1) )
                    secondaryDiagonal = secondaryDiagonal + currentInputValue;
            });
        }

        result.text(mainDiagonal - secondaryDiagonal);
    };
    
    btnGenerateMatrix.on( 'click', generateMatrix );
    btnCalculate.on( 'click', calculate );
});

