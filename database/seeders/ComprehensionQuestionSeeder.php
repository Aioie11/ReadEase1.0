<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReadingMaterial;
use App\Models\ComprehensionQuestion;

class ComprehensionQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, create some sample reading materials if they don't exist
        $englishMaterial = ReadingMaterial::firstOrCreate([
            'title' => 'Maria\'s Story',
            'grade_level' => 7,
            'subject' => 'english'
        ], [
            'content' => 'Here is a story about a young girl named Maria. In a small town by the mountains, she lives with her grandmother and grandfather. Every morning, she happily helps her grandparents with household chores, such as washing dishes and taking care of the animals. Maria feels great joy when she sees her grandparents happy. She also loves reading books, especially stories about nature. She dreams of becoming a teacher one day to help children like her learn and have a bright future.',
            'is_published' => true,
            'published_at' => now()
        ]);

        $filipinoMaterial = ReadingMaterial::firstOrCreate([
            'title' => 'Kwento ni Maria',
            'grade_level' => 7,
            'subject' => 'filipino'
        ], [
            'content' => 'Narito ang isang kwento tungkol sa isang batang babae na nagngangalang Maria. Sa isang maliit na bayan sa tabi ng bundok, nakatira siya sa kanyang lola at lolo. Bawat umaga, masaya niyang tinutulungan ang kanyang mga lolo at lola sa mga gawain sa bahay, tulad ng paghuhugas ng pinggan at pag-aalaga sa mga hayop. Laking tuwa ni Maria kapag nakikita niyang maligaya ang kanyang mga lolo at lola. Mahilig din siya sa pagbabasa ng mga aklat, lalo na ng mga kwento tungkol sa kalikasan. Pinapangarap niyang maging isang guro balang araw upang matulungan ang mga batang katulad niya na nais matuto at magkaroon ng magandang kinabukasan.',
            'is_published' => true,
            'published_at' => now()
        ]);

        // English comprehension questions
        $englishQuestions = [
            [
                'question' => 'Where does Maria live?',
                'type' => 'multiple',
                'options' => ['In a big city', 'In a small town by the mountains', 'Near the ocean', 'In the forest'],
                'correct_answer' => 'In a small town by the mountains',
                'explanation' => 'The story clearly states that Maria lives in a small town by the mountains.',
                'order' => 1
            ],
            [
                'question' => 'Who does Maria live with?',
                'type' => 'multiple',
                'options' => ['Her parents', 'Her grandmother and grandfather', 'Her siblings', 'Her friends'],
                'correct_answer' => 'Her grandmother and grandfather',
                'explanation' => 'The text mentions that she lives with her grandmother and grandfather.',
                'order' => 2
            ],
            [
                'question' => 'What does Maria do every morning?',
                'type' => 'multiple',
                'options' => ['Goes to school', 'Plays with friends', 'Helps with household chores', 'Reads books'],
                'correct_answer' => 'Helps with household chores',
                'explanation' => 'The story states that every morning, she helps her grandparents with household chores.',
                'order' => 3
            ],
            [
                'question' => 'What kind of books does Maria love to read?',
                'type' => 'multiple',
                'options' => ['Adventure stories', 'Stories about nature', 'Mystery books', 'Comic books'],
                'correct_answer' => 'Stories about nature',
                'explanation' => 'The text specifically mentions that she loves reading stories about nature.',
                'order' => 4
            ],
            [
                'question' => 'What does Maria dream of becoming?',
                'type' => 'multiple',
                'options' => ['A doctor', 'A teacher', 'A farmer', 'A writer'],
                'correct_answer' => 'A teacher',
                'explanation' => 'The story ends by mentioning that she dreams of becoming a teacher.',
                'order' => 5
            ]
        ];

        // Filipino comprehension questions
        $filipinoQuestions = [
            [
                'question' => 'Saan nakatira si Maria?',
                'type' => 'multiple',
                'options' => ['Sa malaking lungsod', 'Sa maliit na bayan sa tabi ng bundok', 'Sa tabi ng dagat', 'Sa gubat'],
                'correct_answer' => 'Sa maliit na bayan sa tabi ng bundok',
                'explanation' => 'Nabanggit sa kwento na nakatira si Maria sa isang maliit na bayan sa tabi ng bundok.',
                'order' => 1
            ],
            [
                'question' => 'Kasama ni Maria sa bahay?',
                'type' => 'multiple',
                'options' => ['Ang kanyang mga magulang', 'Ang kanyang lola at lolo', 'Ang kanyang mga kapatid', 'Ang kanyang mga kaibigan'],
                'correct_answer' => 'Ang kanyang lola at lolo',
                'explanation' => 'Nakatira si Maria kasama ang kanyang lola at lolo.',
                'order' => 2
            ],
            [
                'question' => 'Ano ang ginagawa ni Maria tuwing umaga?',
                'type' => 'multiple',
                'options' => ['Pumupunta sa paaralan', 'Naglalaro kasama ang mga kaibigan', 'Tumutulong sa mga gawain sa bahay', 'Nagbabasa ng mga aklat'],
                'correct_answer' => 'Tumutulong sa mga gawain sa bahay',
                'explanation' => 'Bawat umaga, tumutulong si Maria sa mga gawain sa bahay.',
                'order' => 3
            ],
            [
                'question' => 'Anong uri ng mga aklat ang mahilig basahin ni Maria?',
                'type' => 'multiple',
                'options' => ['Mga kwentong pakikipagsapalaran', 'Mga kwento tungkol sa kalikasan', 'Mga mystery books', 'Mga komiks'],
                'correct_answer' => 'Mga kwento tungkol sa kalikasan',
                'explanation' => 'Mahilig si Maria sa pagbabasa ng mga kwento tungkol sa kalikasan.',
                'order' => 4
            ],
            [
                'question' => 'Ano ang pangarap ni Maria?',
                'type' => 'multiple',
                'options' => ['Maging doktor', 'Maging guro', 'Maging magsasaka', 'Maging manunulat'],
                'correct_answer' => 'Maging guro',
                'explanation' => 'Pinapangarap ni Maria na maging guro balang araw.',
                'order' => 5
            ]
        ];

        // Create English questions
        foreach ($englishQuestions as $questionData) {
            ComprehensionQuestion::create(array_merge($questionData, [
                'reading_material_id' => $englishMaterial->id
            ]));
        }

        // Create Filipino questions
        foreach ($filipinoQuestions as $questionData) {
            ComprehensionQuestion::create(array_merge($questionData, [
                'reading_material_id' => $filipinoMaterial->id
            ]));
        }
    }
}
