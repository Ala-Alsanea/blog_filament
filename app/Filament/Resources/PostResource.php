<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\CommentRelationManager;

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
                    ->searchable()
                    ->relationship(name: 'tags', titleAttribute: 'title')
                    ->multiple()
                    ->preload()
                    ->native(false),


                Forms\Components\MarkdownEditor::make('description')
                    ->required()
                    ->maxLength(500),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->imageEditor(),




            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([




                Tables\Columns\TextColumn::make('title')
                    ->description(fn (Post $record): string => substr($record->description, 0, 15))
                    ->searchable()
                    ->weight(FontWeight::Bold),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->searchable()
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('tags.title')
                    ->badge()
                    ->color('warning')
                    ->searchable(),
                ImageColumn::make('image')
                    // ->collection('image')
                    // ->conversion('thumb')
                    ->extraImgAttributes(['class' => 'w-full rounded-xl'])
                    ->square()
                    ->height(100),

            ])
            // ->contentGrid(['md' => 2, 'xl' => 3])
            // ->paginationPageOptions([9, 18, 27])
            // ->modifyQueryUsing(fn (Builder $query)=>$query->published())
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make()
            ])

            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ], position: ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])

            ->emptyStateActions([
                Tables\Actions\Action::make('create')
                    ->label('Create post')
                    ->url(route('filament.admin.resources.posts.create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ]);
    }



    public static function getRelations(): array
    {
        return [
            //
            CommentRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
