<?php

namespace TypeRocket\Models\Meta;

use TypeRocket\Models\Model;
use TypeRocket\Models\WPUser;

class WPUserMeta extends Model
{
    protected $idColumn = 'meta_id';
    protected $resource = 'usermeta';

    protected $builtin = [
        'meta_id',
        'user_id',
        'meta_key',
        'meta_value',
    ];

    protected $guard = [
        'meta_id'
    ];

    public function user( $modelClass ) {

        if( ! $modelClass instanceof WPUser ) {
            return null;
        }

        return $this->belongsTo( $modelClass, 'user_id' );
    }
}