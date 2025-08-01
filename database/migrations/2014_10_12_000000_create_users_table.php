    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('nickname')->unique();
                $table->string('fb_id')->nullable();
                $table->morphs('userable'); // userable_id, userable_type
                $table->string('email')->unique();
                $table->string('nombrecompleto');
                $table->timestamp('email_verified_at')->nullable();
                $table->longText('password')->nullable();
                $table->string('telefono');
                $table->string('biografia')->nullable();
                $table->string('foto')->nullable();
                $table->rememberToken('token', 100);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('users');
        }
    };
