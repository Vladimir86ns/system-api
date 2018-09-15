<?php

namespace App\Transformers\VgSystem;

use App\VgSystem;
use League\Fractal\TransformerAbstract;

class VgSystemTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Investment $investment
     * @return array
     */
    public function transform(VgSystem $vgSystem)
    {
        return [
            'total_investitions' => number_format($vgSystem->total_investitions, 2),
            'collected_to_date' => number_format($vgSystem->collected_to_date, 2),
            'monthly_collected' => number_format($vgSystem->monthly_collected, 2),
        ];
    }
}
