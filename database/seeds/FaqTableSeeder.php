<?php

use Illuminate\Database\Seeder;
use App\Faq;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faq_1 = new Faq();
        $faq_1->question = 'question1';
        $faq_1->answer = 'anwser1';
        $faq_1->save();
    
        $faq_2 = new Faq();
        $faq_2->question = 'question2';
        $faq_2->answer = 'anwser2';
        $faq_2->save();
    
        $faq_3 = new Faq();
        $faq_3->question = 'question3';
        $faq_3->answer = 'anwser3';
        $faq_3->save();
    }
}
