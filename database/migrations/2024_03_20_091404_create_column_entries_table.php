<?php

use App\Models\Column;
use App\Models\Entry;
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
        Schema::create('column_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Entry::class);
            $table->foreignIdFor(Column::class);
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('column_entries');
    }
};
