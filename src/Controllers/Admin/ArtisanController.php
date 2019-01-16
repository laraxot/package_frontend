<?php



namespace XRA\Backend\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artisan;

class ArtisanController extends Controller
{
    //*
    private $plugins = ['LU', 'Agenda', 'Aree', 'Documenti', 'Foto', 'GruppiAdmin', 'Link', 'Modelli', 'Notizie', 'PageClassificator', 'Pagine', 'PagineAdmin'];

    public function exe_raf($comando)
    {
        $output = '';
        try {
            if ('migrate' == $comando) {
                foreach ($this->plugins as $plugin) {
                    Artisan::call('migrate', ['--path' => 'packages/Xot/'.$plugin.'/src/migrations']);
                    $output .= $plugin.': [ ';
                    $output .= Artisan::output();
                    $output .= ' ]';
                }
            } else {
                Artisan::call($comando);
                $output .= '[ '.Artisan::output().' ]';
            }
        } catch (Exception $e) {
            echo '<br/>'.$comando.' non effettuato';
        }
        //return view('backend::admin.index')->with('output', $output);
        return $output;
    }

    //*/
    public function exe($comando)
    {
        try {
            $exitCode = Artisan::call($comando);
            echo '<pre>'.$comando.'[';
            \print_r($exitCode);
            echo ']</pre>';
            echo '<pre>[';
            \print_r(Artisan::output());
            echo ']</pre>';
        } catch (Exception $e) {
            // echo '<pre>';print_r($e);echo '</pre>';
            echo '<br/>'.$comando.' non effettuato';
        }
    }

    //-----------------
}
