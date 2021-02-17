<?php
    /**
     * isValid
     *
     * @abstract Verificar formatcao numero do telefone informadoinformado
     * @param String $nroTelefone
     * @return Boolean $retorno
     */
    function isValid( $nroTelefone )
    {
        $retorno = FALSE;
        if ( is_string( $nroTelefone ) )
        {
            $formatoPadrao = "(XXX) XXX-XXXX";
            $formatoLeitura = preg_replace( '/\d/', 'X', $nroTelefone );
            if ( $formatoLeitura == $formatoPadrao )
            {
                $retorno = TRUE;
            }
        }
        return $retorno;
    }

    /**
     * removeCharacters
     *
     * @abstract Remover caracteres especiais
     * @param String $strOriginal
     * @return String $novaString
     */
    function removeCharacters( $strOriginal )
    {
        $novaString = preg_replace( '/[^a-zA-Z0-9_\s-]/', '', $strOriginal );

        return $novaString;
    }

    /**
     * calculaPontuacao
     *
     * @abstract Calcular ocorrencias
     * @param String $strOcorrencias
     * @param Number $nroJogadores caso queira que o resultado mostre 0 para os demais jogadores mesmo sem valor
     * @return Array $pontuacao
     */
    function calculaPontuacao( $strOcorrencias, $nroJogadores = 3 )
    {
        $pontuacao = [];
        if ( $nroJogadores )
        {
            for ( $nro = 0; $nro < $nroJogadores ; $nro++ )
            {
                $pontuacao[] = 0;
            }
        }
        $contador = [];

        for ( $pos = 0; $pos < strlen( $strOcorrencias ) ; $pos++ )
        {
            $contador[ $strOcorrencias[$pos] ]++;
        }

        foreach ( $contador as $key => $value )
        {
            $pontuacao[ array_search( $key, array_keys($contador)) ] = $value;
        }
        return $pontuacao;
    }

    /**
     * dividirGrupos
     *
     * @abstract Dividir as strings por grupos identicos
     * @param String $strLeitura
     * @return Array $strAgrupada
     */
    function dividirGrupos( $strLeitura )
    {
        $strAgrupada = [];
        $arrAgrupando = [];
        for ( $pos = 0; $pos < strlen( $strLeitura ) ; $pos++ )
        {
            $arrAgrupando[ $strLeitura[$pos] ] .= $strLeitura[$pos];
        }

        foreach ( $arrAgrupando as $key => $value )
        {
            $strAgrupada[ array_search( $key, array_keys($arrAgrupando)) ] = $value;
        }
        return $strAgrupada;
    }

    /**
     * mutiplicar
     *
     * @abstract Mutiplicar um numero por ele mesmo ate 1
     * @param Number $nroMultiplicar
     * @return Number $total
     */
    function mutiplicar( $nroMultiplicar )
    {
        $total = 0;
        if ( !$nroMultiplicar )
        {
            $total = 1;
        }
        else
        {
            $total = $nroMultiplicar * ( mutiplicar( ($nroMultiplicar-1) ) );
        }
        return $total;
    }

echo "Exemplo isValid<br />";
echo (isValid( "(123) 456-7890" ) ? "True" : "False") . "<br />";
echo (isValid( "1111)555 2345" ) ? "True" : "False") . "<br />";
echo (isValid( "098) 123 4567" ) ? "True" : "False") . "<br />";

echo "<br />Exemplo removeCharacters<br />";
echo removeCharacters( "This quick green dog!" ) . "<br />";
echo removeCharacters( '%fd76$fd(-)6GvK1O.') . "<br />";
echo removeCharacters( 'D0n$c sed 0di0 du1' ) . "<br />";

echo "<br />Exemplo calculaPontuacao<br />";
echo print_r( calculaPontuacao( "A", 3 ), true ) . "<br />";
echo print_r( calculaPontuacao( "ABC", 3 ), true ) . "<br />";
echo print_r( calculaPontuacao( "ABCBACC", 3 ), true ) . "<br />";

echo "<br />Exemplo dividirGrupos<br />";
echo print_r( dividirGrupos( "555" ), true ) . "<br />";
echo print_r( dividirGrupos( "5556667788" ), true ) . "<br />";
echo print_r( dividirGrupos( "aaabbbaabbab" ), true ) . "<br />";
echo print_r( dividirGrupos( "8abbbcc88999&&!!!_cab" ), true ) . "<br />";

echo "<br />Exemplo Mutiplicar<br />";
echo mutiplicar( 3 ) . "<br />";
echo mutiplicar( 2 ) . "<br />";
echo mutiplicar( 5 ) . "<br />";
echo mutiplicar( 10 ) . "<br />";


?>