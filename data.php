<?php
class Data{
    public static function validateData($model): bool {
        $dataError = false;
        $vars = get_object_vars($model);
        foreach ($vars as $key => $value) {
            if (str_contains($key, "_error")) {
                if ($value === true) {
                    $dataError = true;
                } else {
                    $dataError = false;
                }
            }
        }
        return $dataError; 
    }
    public static function loadData($model, array $data): void{
            foreach ($data as $key => $value) {
                if (property_exists($model, $key)) {
                    $model->$key = $value;
                }
            }
        }
        
        public static function convert_rn(string $text): string
        {
            return preg_replace('/\v+|\\\r\\\n/ui', '<br/>', $text);
        }
                
        public static function convert_br(string $text): string
        {
            return str_replace('<br/>', "\r\n", $text);
        }
    
        public static function formatDate( $date)
        {
            $date_time = DateTime:: createFromFormat('Y-m-d H:i:s', $date);
            if ($date_time === false) {
                return $date;
            }
            return $date_time->format('d.m.Y H:i:s');
        }

    }
?>