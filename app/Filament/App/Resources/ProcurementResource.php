<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ProcurementResource\Pages;
use App\Filament\App\Resources\ProcurementResource\RelationManagers;
use App\Models\Procurement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProcurementResource extends Resource
{
    protected static ?string $model = Procurement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('requested_by')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('requested_at')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'ordered' => 'Ordered',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->prefix('Rs'),
                Forms\Components\DatePicker::make('approved_at'),
                Forms\Components\TextInput::make('approved_by')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('ordered_at'),
                Forms\Components\DatePicker::make('delivered_at'),
                Forms\Components\Select::make('delivery_status')
                    ->options([
                        'pending' => 'Pending',
                        'in_transit' => 'In Transit',
                        'delivered' => 'Delivered',
                        'failed' => 'Failed',
                    ]),
                Forms\Components\Textarea::make('remarks'),
                Forms\Components\TagsInput::make('tags')
                    ->label('Tags')
                    ->separator(','),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('requested_by')->sortable(),
                Tables\Columns\TextColumn::make('requested_at')->date()->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()->sortable(),
                Tables\Columns\TextColumn::make('amount')->money('LKR', true),
                Tables\Columns\TextColumn::make('vendor'),
                Tables\Columns\TextColumn::make('approved_by'),
                Tables\Columns\TextColumn::make('ordered_at')->date(),
                Tables\Columns\TextColumn::make('delivered_at')->date(),
                Tables\Columns\TextColumn::make('delivery_status')->badge(),
                Tables\Columns\TextColumn::make('remarks')->limit(20),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'ordered' => 'Ordered',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProcurements::route('/'),
            'create' => Pages\CreateProcurement::route('/create'),
            'edit' => Pages\EditProcurement::route('/{record}/edit'),
        ];
    }
}
