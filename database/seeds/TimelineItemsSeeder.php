<?php

use Illuminate\Database\Seeder;
use App\Models\TimelineItem;

class TimelineItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all records from the table.
        DB::table('timeline_items')->delete();

        $timelineItem = new TimelineItem;
        $timelineItem->id = 1;
        $timelineItem->patient_id = 1;
        $timelineItem->type='my type';
        $timelineItem->data='my data';
        $timelineItem->save();
    }
}
