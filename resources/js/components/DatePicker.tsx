"use client"

import * as React from "react"
import { format } from "date-fns"
import { Calendar as CalendarIcon } from "lucide-react"

import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"
import { Calendar } from "@/components/ui/calendar"
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/components/ui/popover"

export function DatePicker({
    date,
    onDateChange,
}: {
    date: Date | undefined
    onDateChange: (date: Date | undefined) => void
}) {
    const [open, setOpen] = React.useState(false)

    return (
        <Popover open={open} onOpenChange={setOpen}>
            <PopoverTrigger asChild>
                <Button
                    variant="outline"
                    className={cn(
                        "w-full justify-between font-normal",
                        !date && "text-muted-foreground"
                    )}
                >
                    {date ? format(date, "yyyy-MM-dd") : "Select Date"}
                    <CalendarIcon className="ml-2 h-4 w-4" />
                </Button>
            </PopoverTrigger>

            <PopoverContent className="w-full rounded-xl p-0">
                <Calendar
                    className="rounded-xl"
                    mode="single"
                    selected={date}
                    onSelect={(d) => {
                        onDateChange(d)
                        setOpen(false)
                    }}
                />
            </PopoverContent>
        </Popover>
    )
}
