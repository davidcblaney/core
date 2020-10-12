<?php
namespace TypeRocket\Console\Commands;

use TypeRocket\Console\Command;
use TypeRocket\Utility\File;

class CoreUpdate extends Command
{
    protected $command = [
        'core:update',
        'Update Core',
        'This command updates a project with any modification needed to core.'
    ];

    /**
     * Execute Command
     *
     * Example command: php galaxy make:controller base member
     *
     * @return int|null|void
     */
    protected function exec()
    {
        $path = tr_config('paths.assets') . '/typerocket';
        $core = tr_config('paths.core') . '/assets/dist';
        $pro = tr_config('paths.pro') . '/assets/dist';

        if(file_exists($core)) {
            (new File($core))->copyTo($path);
            $this->success('Core assets updated');
        } else {
            $this->error('Core assets not found');
        }

        if(file_exists($pro)) {
            (new File($pro))->copyTo($path);
            $this->success('Pro assets updated');

            // merge manifests
            $mix = json_decode(file_get_contents($core . '/mix-manifest.json'), true);
            $mp = json_decode(file_get_contents($pro . '/mix-pro.json'), true);
            $both = array_merge($mix, $mp);
            $all = json_encode($both, JSON_UNESCAPED_SLASHES);
            file_put_contents($path . '/mix-manifest.json', $all);
            $this->success('mix-manifest.json and mix-pro.json merged');
        } else {
            $this->info('TypeRocket Pro not found');
        }
    }

}