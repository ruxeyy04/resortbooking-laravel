<?php

use App\Models\Resort;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resorts', function (Blueprint $table) {
            $table->increments('resort_id');
            $table->string('resort_name');
            $table->string('location');
            $table->text('resort_description');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Resort::insert([
            [
                'resort_name' => 'Nihi Sumba',
                'location' => 'Indonesia',
                'resort_description' => 'Eco-conscious and extraordinarily beautiful, the former surfing retreat of Nihi Sumba scores top billing on lists of the world\'s best beach resorts. It presides over a wild and pristine palm-fringed slice of coast on the remote island of Sumba in Indonesia, about a one-hour flight from Bali.
                It\'s a fitting location considering the resort\'s philosophy is ',
                'price' => 3000,
                'image' => '1.jpg',
            ],
            [
                'resort_name' => 'The Brando',
                'location' => 'Tahiti',
                'resort_description' => 'he resort was established by screen legend Marlon Brando to preserve the island\'s beauty and biodiversity and serve as a model of sustainability —solar power, seawater air-conditioning systems, and other renewable energy technologies power the entire island.

                Not surprisingly, nature lovers will be in heaven here. Flourishing coral reefs shimmer in the lagoon, birds flock to the shores, whales swim by on their annual migrations, and sea turtles nest on the bone-white beaches.
                
                Set back from the beach, the thatched villas peek out unobtrusively from clusters of pandanus and palms. Modern furnishings and fixtures mix effortlessly with recycled and local building materials like thatch, stone, and wood.',
                'price' => 4500,
                'image' => '2.png',
            ],
            [
                'resort_name' => 'Marcus de Suba',
                'location' => 'Lanao',
                'resort_description' => 'Introducing Marcus de Suba Resort - Where Luxury Meets Serenity

                Welcome to Marcus de Suba Resort, an oasis of tranquility nestled amidst breathtaking natural beauty. Located in a pristine coastal setting, our resort offers an unparalleled experience of luxury, comfort, and rejuvenation. With its idyllic location, impeccable service, and world-class amenities, Marcus de Suba Resort promises to be your ultimate getaway destination.
                
                Accommodation:
                Indulge in our meticulously designed accommodations that blend modern sophistication with a touch of local charm. Each spacious room and suite is elegantly furnished, offering panoramic views of the sparkling ocean or lush tropical gardens. Equipped with state-of-the-art amenities and adorned with tasteful decor, our accommodations ensure a truly relaxing stay.
                
                Dining:
                Savor a gastronomic journey at our diverse range of dining venues. From the elegant fine-dining restaurant showcasing a fusion of global flavors to the casual beachfront cafe serving delectable light bites, our culinary offerings cater to every palate. Our talented chefs curate a menu of exquisite dishes using only the freshest local ingredients, guaranteeing an unforgettable dining experience.',
                'price' => 1000,
                'image' => '3.jpg',
            ],
            [
                'resort_name' => 'Aloho',
                'location' => 'Ozamis City',
                'resort_description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, numquam earum ullam aliquam libero, tempore, quasi error repudiandae nihil quo ipsam optio quaerat aspernatur iusto. Error libero quis id consequatur?',
                'price' => 1500,
                'image' => '4.jpg',
            ],
            [
                'resort_name' => 'Regina',
                'location' => 'Ozamiz City',
                'resort_description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam, numquam earum ullam aliquam libero, tempore, quasi error repudiandae nihil quo ipsam optio quaerat aspernatur iusto. Error libero quis id consequatur?',
                'price' => 150,
                'image' => '5.jpg',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resorts');
    }
};
