'use client';
import React, { useEffect } from 'react';
import DashboardLayout from '@/Layouts/DashboardLayout';
import { Button } from '@/Components/ui/button';
import { ImageDown, Loader2, MoreVertical, Plus } from 'lucide-react';
import { Card, CardContent } from '@/Components/ui/card';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog';
import * as z from 'zod';
import { zodResolver } from '@hookform/resolvers/zod';
import { useForm } from 'react-hook-form';
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/Components/ui/form';
import { Input } from '@/Components/ui/input';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select';
import axios from 'axios';

const Clients = () => {
  const [cars, setCars] = React.useState<any[]>([]);
  const getCars = async () => {
    const data = await axios.get('/api/cars').then(res => res.data).catch(err => console.log(err));
    setCars(data);
  };

  React.useEffect(() => {
    getCars();
  }, []);

  return (
    <DashboardLayout>
      <div className={'w-full flex justify-between items-center px-8 py-4'}>
        <div className={'text-4xl font-extrabold'}><span>Liste des clients</span></div>
        <Dialog>
          <DialogTrigger>
            <Button className={'flex gap-1'}><Plus size={16} />Ajouter</Button>
          </DialogTrigger>
          <DialogContent>
            <DialogHeader>
              <DialogTitle>Ajouter un client</DialogTitle>
            </DialogHeader>

          </DialogContent>
        </Dialog>
      </div>
      <span>Clients</span>
    </DashboardLayout>
  );
};

export default Clients;
