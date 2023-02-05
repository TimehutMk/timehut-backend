<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'вработен';

    protected static ?string $pluralModelLabel = 'вработени';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Име')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('surname')
                    ->label('Презиме')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Тел. број')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Е-пошта')
                    ->email()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->label('Адреса')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('employment_date')
                    ->label('Датум на вработување')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Име')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Презиме')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Тел. број')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Е-пошта'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Адреса'),
                Tables\Columns\TextColumn::make('employment_date')
                    ->date()
                    ->label('Датум на вработување')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->fromAuthCompany();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmployees::route('/'),
        ];
    }
}
