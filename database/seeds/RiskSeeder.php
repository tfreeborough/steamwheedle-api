<?php

use Illuminate\Database\Seeder;
use App\Models\Risk;

class RiskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $risks = [
            [
                'risk_id' => 1,
                'name' => 'Very Low',
                'swing' => 1
            ],
            [
                'risk_id' => 2,
                'name' => 'Low',
                'swing' => 2
            ],
            [
                'risk_id' => 3,
                'name' => 'Medium',
                'swing' => 4
            ],
            [
                'risk_id' => 4,
                'name' => 'High',
                'swing' => 8
            ],
            [
                'risk_id' => 5,
                'name' => 'Very High',
                'swing' => 12
            ]
        ];
        $this->process($risks);
    }

    private function process(array $risks)
    {
        foreach ($risks as $props) {
            if (!$risk = Risk::where('name', $props['name'])->first()) {
                $risk = new Risk();
                $risk->fill($props);
                $risk->save();
            } else {
                $risk->swing = $props['swing'];
                $risk->save();
            }

        }
    }
}
