<?php
// carica il codice della classe JSONDB e della classe SmartTV
require_once("JSONDB.php");
require_once("json.php");
require_once("dataTypes.php");
require_once("prodotto.php");

//require("smart_tv.php");

// specifica di usare la classe JSONDB presente nello namespace Jajo
use \Jajo\JSONDB;


class Gestionale {
    private static string $directoryDB = __DIR__;
    private static string $tableName = 'magazzino';
    private static string $fileName = 'magazzino.json';

    /**
     * Restituisce un array di tutte le istanze di SmartTV presenti nel database
     * @return array Array delle istanze individuate
     */
    public static function estrai_tutti(): array {
        $arrayProdotti = [];
        try {
            // crea una istanza di database che fa rifeirmento alla directory specificata
            $db = new JSONDB(self::$directoryDB);
            // estrae tutte tutti gli elementi dal database con nome file smart_tvs.json
            $arrayDB = $db->select( '*' )
            	->from( self::$fileName )
                ->get();
            // scandisce tutto l'array ricavato con la query, istanzia le SmartTV, aggiunge all'array dei risultati
            foreach ($arrayDB as $objDB) {
                $objProdotto = new Prodotto(
                    $objDB["nome"],
                    $objDB["marca"],
                    $objDB["modello"],
                    $objDB["numero_seriale"],
                    $objDB["quantità"],
                );

                $arrayProdotti[] = $objProdotto;
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $arrayProdotti;
    }


    /**
     * Restituisce un'istanza di SmartTV con il numero seriale specificato
     * @param string $numeroSeriale Numero seriale per cui cercare
     * @return null|SmartTv Istanza di SmartTV individuata oppure null se non trovata
     */

    public static function estrai(string $testo): ?Prodotto {
        $objProdotto = null;
        try {
            // crea una istanza di database che fa rifeirmento alla directory specificata
            $db = new JSONDB(self::$directoryDB);
            // estrae tutte tutti gli elementi dal database con nome file smart_tvs.json
            $arrayDB = $db->select( '*' )
            	->from( self::$fileName )
                ->where( [ 'nome' => $testo ] )
                ->get();
            // ci deve essere un unico risultato
            foreach ($arrayDB as $objDB) {
                $objProdotto = new Prodotto(
                    $objDB["nome"],
                    $objDB["marca"],
                    $objDB["modello"],
                    $objDB["numero_seriale"],
                    $objDB["quantità"],
                );
                // ultimo volume memorizzato (attributo di stato)
            
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $objProdotto;
    }


    /**
     * Inserisce nel DB l'istanza di SmartTV specificata
     * @param SmartTv $objSmartTV Istanza da inserire
     * @return bool Risultato dell'operazione: true = successo, false = fallimento
     */
    
     public static function inserisci(Prodotto $objProdotto): bool {
        $operazioneRiuscita = false;
        try {
            // crea un database che sarà memorizzato nella stessa directory di questo file (modificare per altra cartella)
            $db = new JSONDB(self::$directoryDB);
            // crea il file smart_tvs.json se non esiste ed inserisce un oggetto con i dati specificati
            $db->insert( 
                self::$tableName, 
                [
                    'nome' => $objProdotto->nome,
                    'marca' => $objProdotto->marca,
                    'modello' => $objProdotto->modello,
                    'numero_seriale' => $objProdotto->numero_seriale,
                    'quantità' => $objProdotto->quantità,
                ]
            );
            $operazioneRiuscita = true;
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $operazioneRiuscita;
    }

    /**
     * Aggiorna nel DB l'istanza di SmartTV specificata
     * @param SmartTv $objSmartTV Istanza da aggiornare
     * @return bool Risultato dell'operazione: true = successo, false = fallimento
     */
    /*public static function aggiorna(SmartTv $objSmartTV): bool {
        $operazioneRiuscita = false;
        try {
            // crea un database che sarà memorizzato nella stessa directory di questo file (modificare per altra cartella)
            $db = new JSONDB(self::$directoryDB);
            // crea il file smart_tvs.json se non esiste ed inserisce un oggetto con i dati specificati
            $db->update( [ 
                'marca' => $objSmartTV->marca,
                'modello' => $objSmartTV->modello,
                // IPOTESI: NUMERO SERIALE IMMUTABILE  'numero_seriale' => $objSmartTV->numero_seriale,
                'diagonale' => $objSmartTV->diagonale,
                'volume_max' => $objSmartTV->volume_max,
                'volume' => $objSmartTV->volume
            ] )
            ->from( self::$fileName )
            ->where( [ 'numero_seriale' => $objSmartTV->numero_seriale ] )
            ->trigger();
            $operazioneRiuscita = true;
        } catch (\Throwable $th) {
            // throw $th;
        }
        return $operazioneRiuscita;
    }
    */
}
?>