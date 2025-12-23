<?php

namespace App\Filament\Resources\MentalHealthLogs;

use App\Filament\Resources\MentalHealthLogs\Pages\CreateMentalHealthLog;
use App\Filament\Resources\MentalHealthLogs\Pages\EditMentalHealthLog;
use App\Filament\Resources\MentalHealthLogs\Pages\ListMentalHealthLogs;
use App\Filament\Resources\MentalHealthLogs\Schemas\MentalHealthLogForm;
use App\Filament\Resources\MentalHealthLogs\Tables\MentalHealthLogsTable;
use App\Models\MentalHealthLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use UnitEnum;

class MentalHealthLogResource extends Resource
{
   protected static ?string $model = MentalHealthLog::class;

   protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

   protected static string|UnitEnum|null $navigationGroup = 'Health Logs';

   protected static ?string $navigationLabel = 'Mental Health Logs';

   public static function form(Schema $schema): Schema
   {
      return MentalHealthLogForm::configure($schema);
   }

   public static function table(Table $table): Table
   {
      return MentalHealthLogsTable::configure($table);
   }

   public static function getRelations(): array
   {
      return [
         //
      ];
   }

   public static function getPages(): array
   {
      return [
         'index' => ListMentalHealthLogs::route('/'),
         'create' => CreateMentalHealthLog::route('/create'),
         'edit' => EditMentalHealthLog::route('/{record}/edit'),
      ];
   }
}
