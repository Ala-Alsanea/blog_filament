<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;


    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(20),
                Forms\Components\Select::make('category_id')
                    ->relationship(name: 'Category', titleAttribute: 'title')
                    ->searchable()
                    ->preload()
                    ->native(false),
                     Forms\Components\Select::make('tag_id')
                    ->relationship(name: 'tags', titleAttribute: 'title')
                    ->searchable()
                    ->multiple()
                    ->preload()
                    ->native(false),
                Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->maxLength(500),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->imageEditor(),




            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\Layout\Grid::make()
                    ->columns(1)
                    ->schema([


                        ImageColumn::make('image')
                            // ->collection('image')
                            // ->conversion('thumb')
                            ->extraImgAttributes(['class' => 'w-full rounded-xl'])
                            ->square()
                            ->height(200),
                        Tables\Columns\TextColumn::make('title')
                            ->description(fn (Post $record): string => substr($record->description, 0, 15))
                            ->searchable()
                            ->weight(FontWeight::Bold),
                        Tables\Columns\TextColumn::make('category.title')
                            ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),





                        // Tables\Columns\TextColumn::make('created_at')
                        //     ->dateTime()
                        //     ->sortable()
                        //     ->toggleable(isToggledHiddenByDefault: true),
                        // Tables\Columns\TextColumn::make('updated_at')
                        //     ->dateTime()
                        //     ->sortable()
                        //     ->toggleable(isToggledHiddenByDefault: true),


                    ])

            ])
            ->contentGrid(['md' => 2, 'xl' => 3])
            // ->paginationPageOptions([9, 18, 27])
            // ->modifyQueryUsing(fn (Builder $query)=>$query->published())
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make()
            ])

            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            // 'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
