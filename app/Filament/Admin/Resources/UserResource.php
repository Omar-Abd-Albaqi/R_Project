<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Support\Str;
class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                            ->label('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

               TextInput::make('password')
    ->label('كلمة المرور')
    ->password()
    ->revealable() 
    ->helperText(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord
        ? 'اترك الحقل فارغًا إذا كنت لا ترغب في تغييره.'
        : null)
    ->dehydrated(fn ($state) => filled($state))
    ->live() 
    ->suffixAction(
        Action::make('generatePassword')
            ->label('توليد')
            ->icon('heroicon-m-key')
            ->action(function ($state, callable $set) {
                $password = Str::random(10); 
                $set('password', $password); 
            })
    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('email ')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('created_at ')->dateTime(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
