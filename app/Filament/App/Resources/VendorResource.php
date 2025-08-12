    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
<?php

namespace App\Filament\App\Resources;

use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = "fas-money-bill-1";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Repeater::make('contacts')
                    ->label('Contact Persons')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Contact Name')
                            ->required(),
                        Forms\Components\TextInput::make('position')
                            ->label('Position'),
                        Forms\Components\Repeater::make('emails')
                            ->label('Emails')
                            ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->maxLength(255),
                            ])
                            ->default([])
                            ->nullable(),
                        Forms\Components\Repeater::make('phones')
                            ->label('Phones')
                            ->schema([
                                Forms\Components\TextInput::make('phone')
                                    ->maxLength(50),
                            ])
                            ->default([])
                            ->nullable(),
                    ])
                    ->default([])
                    ->nullable(),
                Forms\Components\TextInput::make('address')->maxLength(255),
                Forms\Components\TextInput::make('city')->maxLength(255),
                Forms\Components\TextInput::make('country')->maxLength(255),
                Forms\Components\Textarea::make('notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('country'),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
}
