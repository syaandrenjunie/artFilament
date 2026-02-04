<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Auth\Pages\EditProfile as PageEditProfile;

class EditProfile extends PageEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getAvatarFormComponent(),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                
            ]);
    }

    public function getAvatarFormComponent()
    {
        return FileUpload::make('profile_picture')
            ->label('Profile Picture')
            ->image()
            ->disk('public');
    }
}
