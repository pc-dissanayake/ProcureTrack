<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = "fas-money-bill-1";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\TextInput::make('logo')
                    ->label('Logo URL/Path')
                    ->maxLength(255),
                Forms\Components\TextInput::make('website')
                    ->label('Website')
                    ->maxLength(255),
                Forms\Components\Repeater::make('company_email')
                    ->label('Company Emails')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                    ])
                    ->default([])
                    ->nullable(),
                Forms\Components\Repeater::make('company_phone')
                    ->label('Company Phones')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->maxLength(50),
                    ])
                    ->default([])
                    ->nullable(),
                Forms\Components\Textarea::make('address')->rows(3)->columnSpanFull(),
                Forms\Components\Select::make('country')
                    ->label('Country')
                    ->searchable()
                    ->options(\App\Models\Country::orderBy('name')->pluck('name', 'name')->toArray())
                    ->default('Sri Lanka')
                    ->required()
                    ->live(),
                Forms\Components\Select::make('city')
                    ->label('City')
                    ->searchable()
                    ->options(function ($get) {
                        if ($get('country') === 'Sri Lanka') {
                            return \App\Models\LKCity::orderBy('name_en')->pluck('name_en', 'name_en');
                        }
                        return [];
                    })
                    ->requiredIf('country', stateValues: 'Sri Lanka'),
                Forms\Components\Textarea::make('notes'),


                Forms\Components\Tabs::make('Vendor Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Contacts')
                            ->schema([
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
                            ]),
                    ]),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}
