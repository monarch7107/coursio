<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class LibraryController extends Controller
{
    private function resources(): array
    {
        return [
            ['title'=>'freeCodeCamp','provider'=>'freeCodeCamp','category'=>'Programming','level'=>'Beginner → Advanced','type'=>'Free learning + free certificates','description'=>'Project-based web development, JavaScript, Python, databases, and more.','url'=>'https://www.freecodecamp.org/learn/','tags'=>'HTML CSS JavaScript Python'],
            ['title'=>'Microsoft Learn','provider'=>'Microsoft','category'=>'Cloud & DevOps','level'=>'Beginner → Advanced','type'=>'Free learning; credential varies','description'=>'Official learning paths for Azure, security, data, AI, and Microsoft tools.','url'=>'https://learn.microsoft.com/training/','tags'=>'Azure Cloud AI Security'],
            ['title'=>'Cisco Skills for All','provider'=>'Cisco','category'=>'Cybersecurity','level'=>'Beginner → Intermediate','type'=>'Free learning + selected free badges','description'=>'Introductory networking, cybersecurity, Python, and digital skills courses.','url'=>'https://skillsforall.com/','tags'=>'Networking Security Python'],
            ['title'=>'IBM SkillsBuild','provider'=>'IBM','category'=>'Data & AI','level'=>'Beginner → Intermediate','type'=>'Free learning + selected digital credentials','description'=>'Career-focused learning in AI, data, cybersecurity, and workplace skills.','url'=>'https://skillsbuild.org/','tags'=>'AI Data Cybersecurity'],
            ['title'=>'AWS Skill Builder','provider'=>'Amazon Web Services','category'=>'Cloud & DevOps','level'=>'Beginner → Advanced','type'=>'Free learning; certification exams paid','description'=>'Digital training for cloud fundamentals and AWS services. Official certification exams generally cost extra.','url'=>'https://skillbuilder.aws/','tags'=>'AWS Cloud'],
            ['title'=>'Kaggle Learn','provider'=>'Kaggle','category'=>'Data & AI','level'=>'Beginner → Intermediate','type'=>'Free micro-courses; completion records vary','description'=>'Short hands-on lessons in Python, pandas, machine learning, SQL, and visualization.','url'=>'https://www.kaggle.com/learn','tags'=>'Python SQL Machine Learning'],
            ['title'=>'SQLBolt','provider'=>'SQLBolt','category'=>'Data & AI','level'=>'Beginner','type'=>'Free learning; no certificate','description'=>'Interactive SQL lessons and exercises for learning database fundamentals.','url'=>'https://sqlbolt.com/','tags'=>'SQL Database'],
            ['title'=>'The Odin Project','provider'=>'The Odin Project','category'=>'Programming','level'=>'Beginner → Advanced','type'=>'Free learning; no certificate','description'=>'Open curriculum for full-stack web development with practical projects.','url'=>'https://www.theodinproject.com/','tags'=>'HTML CSS JavaScript Ruby'],
            ['title'=>'PortSwigger Web Security Academy','provider'=>'PortSwigger','category'=>'Cybersecurity','level'=>'Beginner → Advanced','type'=>'Free labs; credential varies','description'=>'Interactive web security training and legal practice labs for common vulnerabilities.','url'=>'https://portswigger.net/web-security','tags'=>'Security Web OWASP'],
            ['title'=>'Hugging Face Course','provider'=>'Hugging Face','category'=>'Data & AI','level'=>'Intermediate','type'=>'Free learning; no certificate','description'=>'Learn transformers, NLP, datasets, tokenizers, and practical machine learning workflows.','url'=>'https://huggingface.co/learn','tags'=>'AI NLP Transformers'],
            ['title'=>'Salesforce Trailhead','provider'=>'Salesforce','category'=>'Business Technology','level'=>'Beginner → Intermediate','type'=>'Free learning + free badges','description'=>'Learn CRM, business workflows, and Salesforce platform skills through modules and trails.','url'=>'https://trailhead.salesforce.com/','tags'=>'CRM Business Salesforce'],
            ['title'=>'HubSpot Academy','provider'=>'HubSpot','category'=>'Commerce & Business','level'=>'Beginner → Intermediate','type'=>'Free courses + selected free certifications','description'=>'Courses in digital marketing, sales, customer service, and CRM. Check each course for current certification terms.','url'=>'https://academy.hubspot.com/','tags'=>'Marketing Sales CRM'],
            ['title'=>'OpenLearn','provider'=>'The Open University','category'=>'Commerce & Business','level'=>'Beginner','type'=>'Free learning; statement varies','description'=>'Open courses in business, digital skills, and IT. Completion records vary by course.','url'=>'https://www.open.edu/openlearn/','tags'=>'Business Digital Skills'],
            ['title'=>'NPTEL','provider'=>'NPTEL / IITs','category'=>'Commerce & Business','level'=>'Beginner → Advanced','type'=>'Free learning; paid exam certificate','description'=>'University-level technology, management, and business learning. Proctored certificate exams are generally paid.','url'=>'https://nptel.ac.in/','tags'=>'Business Management IT'],
            ['title'=>'Google Cloud Skills Boost','provider'=>'Google Cloud','category'=>'Cloud & DevOps','level'=>'Beginner → Advanced','type'=>'Selected free badges; access varies','description'=>'Cloud learning paths and hands-on activities; some labs may require credits or payment.','url'=>'https://cloud.google.com/learn','tags'=>'Cloud Google DevOps'],
            ['title'=>'Python Documentation','provider'=>'Python','category'=>'Programming','level'=>'All levels','type'=>'Free learning; no certificate','description'=>'Official Python tutorial, language reference, and standard-library documentation.','url'=>'https://docs.python.org/3/','tags'=>'Python Programming'],
            ['title'=>'Docker Get Started','provider'=>'Docker','category'=>'Cloud & DevOps','level'=>'Beginner','type'=>'Free learning; no certificate','description'=>'Official hands-on introduction to containers, images, and Compose.','url'=>'https://docs.docker.com/get-started/','tags'=>'Docker Containers DevOps'],
            ['title'=>'Odoo Documentation','provider'=>'Odoo','category'=>'Business Technology','level'=>'Intermediate','type'=>'Free learning; no certificate','description'=>'Documentation for ERP systems, business workflows, modules, and integrations.','url'=>'https://www.odoo.com/documentation','tags'=>'ERP Business Python'],
        ];
    }

    public function health(): JsonResponse
    {
        return response()->json(['status' => 'ok', 'app' => 'Coursio']);
    }

    public function index(Request $request): View
    {
        $all = collect($this->resources());
        $q = trim((string)$request->query('q', ''));
        $category = (string)$request->query('category', 'All topics');
        $credential = (string)$request->query('credential', 'All credentials');
        $filtered = $all->filter(function ($item) use ($q, $category, $credential) {
            $haystack = strtolower($item['title'].' '.$item['provider'].' '.$item['description'].' '.$item['tags']);
            $type = strtolower($item['type']);
            return (!$q || str_contains($haystack, strtolower($q)))
                && ($category === 'All topics' || $item['category'] === $category)
                && ($credential === 'All credentials'
                    || ($credential === 'Free certificates' && str_contains($type, 'free certificates'))
                    || ($credential === 'Free badges' && str_contains($type, 'free badges'))
                    || ($credential === 'No certificate' && str_contains($type, 'no certificate'))
                    || ($credential === 'Paid certificate' && str_contains($type, 'paid exam')));
        })->values();
        return view('library', [
            'resources'=>$filtered, 'total'=>$all->count(), 'q'=>$q,
            'category'=>$category, 'credential'=>$credential,
            'categories'=>$all->pluck('category')->unique()->sort()->values(),
        ]);
    }
}
