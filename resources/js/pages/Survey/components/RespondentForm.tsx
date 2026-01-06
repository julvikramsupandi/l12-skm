import { useForm } from '@inertiajs/react'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card"
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import { DatePicker } from '@/components/DatePicker'
import { useState } from 'react'
import { is } from 'date-fns/locale'
import { Separator } from '@/components/ui/separator'
import { CheckCheckIcon, CheckCircle2Icon, CheckCircleIcon } from 'lucide-react'

interface RespondentFormProps {
    uuid: string,
    serviceId: number,
    serviceName: string
}

export default function RespondentForm({ uuid, serviceId, serviceName }: RespondentFormProps) {
    const { data, setData, post, processing, errors } = useForm({
        survey_date: new Date().toISOString().split('T')[0],
        survey_time: '08.00 - 12.00',
        respondent_name: '',
        age: '',
        gender: 'L',
        education: '',
        occupation: '',
        is_disability: false,
        disability_type: '',
    })

    const submit = (e: React.FormEvent) => {
        e.preventDefault()

        post(route('survey.store', [uuid, serviceId])) // sesuaikan route
    }

    const [date, setDate] = useState<Date | undefined>(
        data.survey_date ? new Date(data.survey_date) : undefined
    )

    return (
        <form onSubmit={submit} className="space-y-6">
            <Card className='backdrop-blur bg-card/75 border-primary/25 '>
                <CardHeader>
                    <CardTitle>{serviceName}</CardTitle>
                    <CardDescription>
                        Silakan lengkapi formulir responden
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div className='grid  md:grid-cols-6 lg:grid-cols-12 gap-5'>


                        <div className='md:col-span-3 lg:col-span-3'>
                            <Label>Tanggal</Label>
                            <div className='mt-1'>
                                <DatePicker date={date} onDateChange={setDate} />
                            </div>
                            {
                                errors.survey_date && (
                                    <p className="mt-1 text-xs text-red-500">
                                        * {errors.survey_date}
                                    </p>
                                )
                            }
                        </div>


                        <div className='md:col-span-3 lg:col-span-3'>
                            <Label>Jam</Label>
                            <Select
                                value={data.survey_time}
                                onValueChange={(value) => setData('survey_time', value)}
                            >
                                <SelectTrigger className='mt-1'>
                                    <SelectValue placeholder="- Pilih Jam -" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="08.00 - 12.00">08.00 - 12.00</SelectItem>
                                    <SelectItem value="13.00 - 17.00">13.00 - 17.00</SelectItem>
                                </SelectContent>
                            </Select>
                            {
                                errors.survey_time && (
                                    <p className="mt-1 text-xs text-red-500">
                                        * {errors.survey_time}
                                    </p>
                                )
                            }
                        </div>



                        <div className='md:col-span-6 lg:col-span-6'>
                            <Label>Nama</Label>
                            <Input
                                className='mt-1'
                                placeholder='Nama'
                                value={data.respondent_name}
                                onChange={(e) => setData('respondent_name', e.target.value)}
                                required
                            />
                            {
                                errors.respondent_name && (
                                    <p className="mt-1 text-xs text-red-500">
                                        * {errors.respondent_name}
                                    </p>
                                )
                            }
                        </div>



                        <div className='md:col-span-3 lg:col-span-1'>
                            <Label>Usia</Label>
                            <Input
                                className='mt-1'
                                placeholder='Usia'
                                type="number"
                                value={data.age}
                                onChange={(e) => setData('age', e.target.value)}
                                required
                            />
                            {
                                errors.age && (
                                    <p className="mt-1 text-xs text-red-500">
                                        * {errors.age}
                                    </p>
                                )
                            }
                        </div>

                        <div className='md:col-span-3 lg:col-span-2'>
                            <Label>Jenis Kelamin</Label>
                            <Select
                                value={data.gender}
                                onValueChange={(value) => setData('gender', value)}
                                required
                            >
                                <SelectTrigger className='mt-1'>
                                    <SelectValue placeholder="- Pilih Jenis Kelamin -" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="P">Perempuan</SelectItem>
                                    <SelectItem value="L">Laki-laki</SelectItem>
                                </SelectContent>
                            </Select>
                            {
                                errors.gender && (
                                    <p className="mt-1 text-xs text-red-500">
                                        * {errors.gender}
                                    </p>
                                )
                            }
                        </div>

                        <div className='md:col-span-3 lg:col-span-2'>
                            <Label>Pendidikan</Label>
                            <Select
                                value={data.education}
                                onValueChange={(value) => setData('education', value)}
                                required
                            >
                                <SelectTrigger className='mt-1'>
                                    <SelectValue placeholder="- Pilih Pendidikan -" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="Tidak sekolah">Tidak sekolah</SelectItem>
                                    <SelectItem value="SD/Sederajat">SD/Sederajat</SelectItem>
                                    <SelectItem value="SMP/Sederajat">SMP/Sederajat</SelectItem>
                                    <SelectItem value="SMA/Sederajat">SMA/Sederajat</SelectItem>
                                    <SelectItem value="D1/D2/D3">D1/D2/D3</SelectItem>
                                    <SelectItem value="D4/S1">D4/S1</SelectItem>
                                    <SelectItem value="S2">S2</SelectItem>
                                    <SelectItem value="S3">S3</SelectItem>

                                </SelectContent>
                            </Select>
                            {
                                errors.education && (
                                    <p className="mt-1 text-xs text-red-500">
                                        * {errors.education}
                                    </p>
                                )
                            }
                        </div>

                        <div className='md:col-span-3 lg:col-span-2'>
                            <Label>Pekerjaan</Label>
                            <Select
                                value={data.occupation}
                                onValueChange={(value) => setData('occupation', value)}
                                required
                            >
                                <SelectTrigger className='mt-1'>
                                    <SelectValue placeholder="- Pilih Pekerjaan -" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="ASN">ASN</SelectItem>
                                    <SelectItem value="TNI">TNI</SelectItem>
                                    <SelectItem value="POLRI">POLRI</SelectItem>
                                    <SelectItem value="Swasta">Swasta</SelectItem>
                                    <SelectItem value="Wirausaha">Wirausaha</SelectItem>
                                    <SelectItem value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</SelectItem>
                                    <SelectItem value="Petani/Nelayan">Petani/Nelayan</SelectItem>
                                    <SelectItem value="Pekerja Lepas/Freelance">Pekerja Lepas/Freelance</SelectItem>
                                    <SelectItem value="Pensiunan">Pensiunan</SelectItem>
                                    <SelectItem value="Lainnya">Lainnya</SelectItem>
                                </SelectContent>
                            </Select>
                            {
                                errors.occupation && (
                                    <p className="mt-1 text-xs text-red-500">
                                        * {errors.occupation}
                                    </p>
                                )
                            }
                        </div>

                        <div className='md:col-span-3 lg:col-span-2'>
                            <div>
                                <Label className='text-nowrap'>Penyandang disabilitas</Label>
                                <Select
                                    value={data.is_disability ? '1' : '0'}
                                    onValueChange={(value) => setData('is_disability', value == '1' ? true : false)}
                                    required
                                >
                                    <SelectTrigger className='mt-1'>
                                        <SelectValue placeholder="- Pilih -" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="1">YA</SelectItem>
                                        <SelectItem value="0">TIDAK</SelectItem>
                                    </SelectContent>
                                </Select>
                                {
                                    errors.is_disability && (
                                        <p className="mt-1 text-xs text-red-500">
                                            * {errors.is_disability}
                                        </p>
                                    )
                                }
                            </div>
                        </div>


                        <div className='md:col-span-3 lg:col-span-3'>
                            <Label>Jika YA, Pilih jenis disabilitas</Label>
                            <Select
                                value={data.disability_type}
                                onValueChange={(value) => setData('disability_type', value)}
                                required
                            >
                                <SelectTrigger className='mt-1'>
                                    <SelectValue placeholder="- Pilih Jenis Disabilitas -" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="Disabilitas Fisik">Disabilitas Fisik</SelectItem>
                                    <SelectItem value="Disabilitas Intelektual">Disabilitas Intelektual</SelectItem>
                                    <SelectItem value="Disabilitas Mental">Disabilitas Mental</SelectItem>
                                    <SelectItem value="Disabilitas Sensorik">Disabilitas Sensorik</SelectItem>
                                </SelectContent>
                            </Select>
                            {
                                errors.disability_type && (
                                    <p className="mt-1 text-xs text-red-500">
                                        * {errors.disability_type}
                                    </p>
                                )
                            }

                        </div>
                    </div>
                    <Separator className='mt-5' />
                </CardContent>
                <CardFooter>
                    <Button className='w-full' type="submit" disabled={processing}>
                        <CheckCircleIcon />
                        Mulai Survei
                    </Button>
                </CardFooter>
            </Card>
        </form >
    )
}
